<?php

namespace App\Http\Controllers\Backend\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\EmployeeAttendance;
use niklasravnsborg\LaravelPdf\Facades\PDF;

class AttenReportController extends Controller
{
    public function AttenReportView()
    {
        $data['employees'] = User::where('usertype','Employee')->get();
        return view('backend.report.attend_report.attend_report_view', $data);
    }

    public function AttenReportGet(Request $request)
    {
        $employee_id = $request->employee_id;
        if($employee_id !='') {
            $where[] = ['employee_id',$employee_id];
        }
        $date = date('Y-m',strtotime($request->date));
        if($date !='') {
            $where[] = ['date','like', $date.'%'];
        }

        $singleAttendance = EmployeeAttendance::with(['user'])->where($where)->where('date',date('Y-m-d',strtotime($request->date)))->get();

        if($singleAttendance == true) {
            $data['allData'] = EmployeeAttendance::with(['user'])->where($where)->orderBy('date')->get();

            $data['absents'] = EmployeeAttendance::with(['user'])->where($where)->where('attend_status','Absent')->get()->count();
            $data['leaves'] = EmployeeAttendance::with(['user'])->where($where)->where('attend_status','Leave')->get()->count();
            $data['month'] = date('M Y', strtotime($request->date));

            $pdf = PDF::loadView('backend.report.attend_report.attend_report_pdf', $data);
            $pdf->SetProtection(['copy', 'print'], '', 'pass');
            return $pdf->stream('document.pdf');
        } else {
            $notification = array(
                'message' => 'Sorry, This Criteria does not match..',
                'alert-type' => 'error'
            );
    
            return redirect()->back()->with($notification);
        }
    }
}
