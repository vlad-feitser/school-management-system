<?php

namespace App\Http\Controllers\Backend\Employee;

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

class MonthlySalaryController extends Controller
{
    public function MonthlySalaryView()
    {
        return view('backend.employee.employee_monthly_salary.employee_monthly_salary_view');
    }

    public function MonthlySalaryGet(Request $request)
    {
            $date = date('Y-m',strtotime($request->date));
            if ($date !='') {
            $where[] = ['date','like',$date.'%'];
            }
            
            $data = EmployeeAttendance::select('employee_id')->groupBy('employee_id')->with(['user'])->where($where)->get();
            // dd($allStudent);
            $html['thsource']  = '<th>SL</th>';
            $html['thsource'] .= '<th>Employee Name</th>';
            $html['thsource'] .= '<th>Basic Salary</th>';
            $html['thsource'] .= '<th>Salary This Month</th>';
            $html['thsource'] .= '<th>Action</th>';


            foreach ($data as $key => $attend) {
            $totalAttend = EmployeeAttendance::with(['user'])->where($where)->where('employee_id',$attend->employee_id)->get();
            $absentCount = count($totalAttend->where('attend_status', 'Absent'));
            
            $color = 'success';
            $html[$key]['tdsource']  = '<td>'.($key+1).'</td>';
            $html[$key]['tdsource'] .= '<td>'.$attend['user']['name'].'</td>';
            $html[$key]['tdsource'] .= '<td>'.$attend['user']['salary'].'$'.'</td>';
            
            $salary = (float)$attend['user']['salary'];
            $salary_per_day = (float)$salary/30;
            $total_salary_minus = (float)$absentCount*(float)$salary_per_day;
            $total_salary = (int)((float)$salary - (float)$total_salary_minus);

            $html[$key]['tdsource'] .='<td>'.$total_salary.'$'.'</td>';
            $html[$key]['tdsource'] .='<td>';
            $html[$key]['tdsource'] .='<a class="btn btn-sm btn-'.$color.'" title="PaySlip" target="_blanks" href="'.route("employee.monthly.salary.payslip", $attend->employee_id).'">Fee Slip</a>';
            $html[$key]['tdsource'] .= '</td>';

        }  
        return response()->json(@$html);
    }

    public function MonthlySalaryPayslip(Request $request, $employee_id)
    {
        $id = EmployeeAttendance::where('employee_id', $employee_id)->first();
        $date = date('Y-m',strtotime($id->date));
            if ($date !='') {
            $where[] = ['date','like',$date.'%'];
            }
        $data['details'] = EmployeeAttendance::with(['user'])->where($where)->where('employee_id',$id->employee_id)->get();

        $pdf = PDF::loadView('backend.employee.employee_monthly_salary.employee_monthly_salary_pdf', $data);
	    $pdf->SetProtection(['copy', 'print'], '', 'pass');
	    return $pdf->stream('document.pdf');
    }
}
