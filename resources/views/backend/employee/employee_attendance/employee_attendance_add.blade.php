@extends('admin.admin_master')
@section('admin')


<div class="content-wrapper">
    <div class="container-full">
   
        <section class="content">

            <!-- Basic Forms -->
             <div class="box">
               <div class="box-header with-border">
                 <h4 class="box-title">Add Attendance</h4>
               </div>
               <!-- /.box-header -->
               <div class="box-body">
                 <div class="row">
                   <div class="col">


        <form method="post" action="{{ route('store.employee.attendance') }}">
            @csrf

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <h5>Attendance Date <span class="text-danger">*</span></h5>
                <div class="controls">
                    <input type="date" name="date" class="form-control" required="">
                </div>
            </div>
        </div>{{-- End Col-md-6 --}}
    </div> {{-- End Row --}}


    <div class="row">
        <div class="col-md-12">
            <table class="table table-bordered table-striped" style="width: 100%">
                <thead>
                    <tr>
                        <th rowspan="2" class="text-center" style="vertical-align:middle;">Sl</th>
                        <th rowspan="2" class="text-center" style="vertical-align:middle;">Employee List</th>
                        <th colspan="3" class="text-center" style="vertical-align:middle; width:30%">Attendance Status</th>
                    </tr>
                    <tr class="text-center text-white" style="border: 1px solid black;">
                        <th class="present_all" style="background-color:#152a66;">Present</th>
                        <th class="present_all" style="background-color:#152a66;">Leave</th>
                        <th class="present_all" style="background-color:#152a66;">Absent</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($employees as $key => $employee)
                        
                    <tr id="div{{$employee->id}}">
                        <input type="hidden" name="employee_id[]" value="{{ $employee->id }}">
                        <td  class="text-center">{{$key+1}}</td>
                        <td  class="text-center">{{$employee->name}}</td>
                        <td colspan="3"  >
                            <div class="switch-toogle switch-3 switch-candy">
                                <input name="attend_status{{$key}}" type="radio" value="Present" id="present{{$key}}" checked="checked">
                                <label style="padding-right:24px;border-right-style: solid" for="present{{$key}}">Present</label>

                                <input name="attend_status{{$key}}" type="radio" value="Leave" id="leave{{$key}}">
                                <label style="padding-right:15px;border-right-style: solid" class="ml-10" for="leave{{$key}}">Leave</label>

                                <input name="attend_status{{$key}}" type="radio" value="Absent" id="absent{{$key}}">
                                <label class="ml-10" for="absent{{$key}}">Absent</label>
                            </div>
                        </td>
                    </tr>

                    @endforeach
                </tbody>
            </table>
        </div> {{-- End Col-md-12 --}}
    </div> {{-- End Row --}}
                    


            <div class="text-xs-right">
                <input type="submit" class="btn btn-rounded btn-info mb-5" value="Submit">
            </div>
        </form>

                   </div>
                   <!-- /.col -->
                 </div>
                 <!-- /.row -->
               </div>
               <!-- /.box-body -->
             </div>
             <!-- /.box -->
   
           </section>



    
    </div>
</div>

@endsection 