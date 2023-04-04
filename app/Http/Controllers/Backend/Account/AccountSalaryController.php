<?php

namespace App\Http\Controllers\Backend\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AssignStudent;
use App\Models\User;
use App\Models\DiscountStudent;

use App\Models\StudentYear;
use App\Models\StudentClass;
use App\Models\StudentGroup;
use App\Models\StudentShift;
use Illuminate\Support\Facades\DB;

use niklasravnsborg\LaravelPdf\Facades\PDF;

use App\Models\Designation;
use App\Models\EmployeeSalaryLog;
use App\Models\EmployeeAttendance;
use App\Models\AccountEmployeeSalary;

class AccountSalaryController extends Controller
{
    public function AccountSalaryView()
    {
        $data['allData'] = AccountEmployeeSalary::all();
        return view('backend.account.employee_salary.employee_salary_view', $data);
    }

    public function AccountSalaryAdd()
    {
        return view('backend.account.employee_salary.employee_salary_add');
    }

    public function AccountSalaryGetEmployee(Request $request)
    {
        $date = date('Y-m',strtotime($request->date));
            if ($date !='') {
            $where[] = ['date','like',$date.'%'];
            }
            
            $data = EmployeeAttendance::select('employee_id')->groupBy('employee_id')->with(['user'])->where($where)->get();
            // dd($allStudent);
            $html['thsource']  = '<th>SL</th>';
            $html['thsource'] .= '<th>ID №</th>';
            $html['thsource'] .= '<th>Employee Name</th>';
            $html['thsource'] .= '<th>Basic Salary</th>';
            $html['thsource'] .= '<th>Salary This Month</th>';
            $html['thsource'] .= '<th>Select</th>';


            foreach ($data as $key => $attend) {

                $account_salary = AccountEmployeeSalary::where('employee_id', $attend->employee_id)->where('date',$date)->first();

                if($account_salary !=null) {
                    $checked = 'checked';
                   }else{
                    $checked = '';
                   }

            $totalAttend = EmployeeAttendance::with(['user'])->where($where)->where('employee_id',$attend->employee_id)->get();
            $absentCount = count($totalAttend->where('attend_status', 'Absent'));

            $html[$key]['tdsource']  = '<td>'.($key+1).'</td>';
            $html[$key]['tdsource'] .= '<td>'.$attend['user']['id_no'].'<input type="hidden" name="date" value="'.$date.'">'.'</td>';
            $html[$key]['tdsource'] .= '<td>'.$attend['user']['name'].'</td>';
            $html[$key]['tdsource'] .= '<td>'.$attend['user']['salary'].'$'.'</td>';
            
            $salary = (float)$attend['user']['salary'];
            $salary_per_day = (float)$salary/30;
            $total_salary_minus = (float)$absentCount*(float)$salary_per_day;
            $total_salary = (int)((float)$salary - (float)$total_salary_minus);

            $html[$key]['tdsource'] .='<td>'.$total_salary.'$'.'<input type="hidden" name="amount[]" value="'.$total_salary.'">'.'</td>';
            $html[$key]['tdsource'] .='<td>'.'<input type="hidden" name="employee_id[]" value="'.$attend->employee_id.'">'.
                                    '<input type="checkbox" name="checkmanage[]" id="'.$key.'" value="'.$key.'" '.$checked.' 
                                    style="transform: scale(1.5);margin-left: 10px;"> <label for="'.$key.'"> </label> '.'</td>'; 

        }  
        return response()->json(@$html);
    }

    public function AccountSalaryStore(Request $request)
    {
        $date = date('Y-m',strtotime($request->date));

		AccountEmployeeSalary::where('date',$date)->delete();

		$checkData = $request->checkmanage;
		if($checkData != null) {
			for($i = 0; $i < count($checkData); $i++){
				$data = new AccountEmployeeSalary();
				$data->date = $date;
				$data->employee_id = $request->employee_id[$checkData[$i]];
				$data->amount = $request->amount[$checkData[$i]];
				$data->save();
			}
		}

		if(!empty(@$data) || empty($checkData)) {

			$notification = array(
				'message' => 'Well Done Data Successfully Updated!',
				'alert-type' => 'success'
			);
	
			return redirect()->route('account.salary.view')->with($notification);
		} else{

			$notification = array(
				'message' => 'Sorry, Data Not Saved!',
				'alert-type' => 'error'
			);
	
			return redirect()->back()->with($notification);
		}
    } 
}
