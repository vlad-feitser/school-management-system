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
use App\Models\EmployeeLeave;
use App\Models\LeavePurpose;
use App\Models\EmployeeAttendance;

class EmployeeAttendanceController extends Controller
{
    public function AttendanceView()
    {
        $data['allData'] = EmployeeAttendance::select('date')->groupBy('date')->orderBy('date', 'desc')->get();
        // $data['allData'] = EmployeeAttendance::orderBy('id', 'desc')->get();
        return view('backend.employee.employee_attendance.employee_attendance_view', $data);
    }

    public function AttendanceAdd()
    {
        $data['employees'] = User::where('usertype', 'Employee')->get();
        return view('backend.employee.employee_attendance.employee_attendance_add', $data);
    }

    public function AttendanceStore(Request $request)
    {
        EmployeeAttendance::where('date', date('Y-m-d', strtotime($request->date)))->delete();
        $count_employee = count($request->employee_id);
        for($i = 0; $i < $count_employee; $i++){
            $attend_status = 'attend_status'.$i;
            $attend = new EmployeeAttendance();
            $attend->date = date('Y-m-d', strtotime($request->date));
            $attend->employee_id = $request->employee_id[$i];
            $attend->attend_status = $request->$attend_status;
            $attend->save();
        }

        $notification = array(
            'message' => 'Employee Attendance Data Updated Successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('employee.attendance.view')->with($notification);
    }

    public function AttendanceEdit($date)
    {
        $data['editData'] = EmployeeAttendance::where('date', $date)->get();
        $data['employees'] = User::where('usertype', 'Employee')->get();
        return view('backend.employee.employee_attendance.employee_attendance_edit', $data);
    }

    public function AttendanceDetails($date)
    {
        $data['details'] = EmployeeAttendance::where('date', $date)->get();
        return view('backend.employee.employee_attendance.employee_attendance_details', $data);
    }
}
