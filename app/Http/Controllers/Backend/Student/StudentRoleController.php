<?php

namespace App\Http\Controllers\Backend\Student;

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

class StudentRoleController extends Controller
{
    public function StudentRoleView()
    {
        $data['years'] = StudentYear::all();
        $data['classes'] = StudentClass::all();
        return view('backend.student.role_generate.role_generate_view', $data);
    }

    public function GetStudents(Request $request)
    {
        $allData = AssignStudent::with(['student'])->where('year_id', $request->year_id)->where('class_id', $request->class_id)->get();
        
        return response()->json($allData);
    }

    public function StudentRoleStore(Request $request)
    {
        $year_id = $request->year_id;
        $class_id = $request->class_id;

        if($request->student_id !=null) {
            for($i = 0; $i < count($request->student_id); $i++) {
                AssignStudent::where('year_id',$year_id)->where('class_id', $request->class_id)->where('student_id',$request->student_id[$i])->update(['roll' => $request->roll[$i]]);
            } // end for

            $notification = array(
                'message' => 'Well Done Role Generated Successfully!',
                'alert-type' => 'success'
            );
    
            return redirect()->route('role.generate.view')->with($notification);
            
        } else{
            $notification = array(
                'message' => 'Sorry, student not found..',
                'alert-type' => 'error'
            );
    
            return redirect()->back()->with($notification);
        }
    }
}
