@extends('admin.admin_master')
@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


<div class="content-wrapper">
    <div class="container-full">
   
        <section class="content">

            <!-- Basic Forms -->
             <div class="box">
               <div class="box-header with-border">
                 <h4 class="box-title"> Student Promotion </h4>
                 <h5 class="widget-user-username mb-0">Student Name: {{ $editData['student']['name'] }}</h5>
               </div>
               <!-- /.box-header -->
               <div class="box-body">
                 <div class="row">
                   <div class="col">


        <form method="post" action="{{ route('update.student.promotion', $editData->student_id) }}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" value="{{ $editData->id }}">

            <div class="row"> <!-- 3rd Row-->

                <div class="col-md-4">
                    <div class="form-group">
                        <h5>Discount <span class="text-danger">*</span></h5>
                        <div class="controls">
                            <input type="text" name="discount" class="form-control" required="" value="{{ $editData['discount']['discount'] }}">
                        </div>
                    </div>
                </div> <!-- End Col-4 -->


                <div class="col-md-4">
                    <div class="form-group">
                        <h5>Year <span class="text-danger">*</span></h5>
                        <div class="controls">
                            <select name="year_id" required="" class="form-control">
                                <option value="" selected="" disabled="">Select Year</option>

                                @foreach ($years as $year)
                                    <option value="{{ $year->id }}" {{ ($editData->year_id == $year->id) ? 'selected' : '' }}>{{ $year->name }}</option>
                                @endforeach
                                
                            </select>
                        </div>
                    </div>
                </div> <!-- End Col-4 -->


                <div class="col-md-4">
                    <div class="form-group">
                        <h5>Class <span class="text-danger">*</span></h5>
                        <div class="controls">
                            <select name="class_id" required="" class="form-control">
                                <option value="" selected="" disabled="">Select Class</option>
                                
                                @foreach ($classes as $class)
                                    <option value="{{ $class->id }}" {{ ($editData->class_id == $class->id) ? 'selected' : '' }}>{{ $class->name }}</option>
                                @endforeach
                                
                            </select>
                        </div>
                    </div>
                </div> <!-- End Col-4 -->


            </div> <!-- End Row -->






            <div class="row"> <!-- 4th Row-->

  
                <div class="col-md-4">
                    <div class="form-group">
                        <h5>Group <span class="text-danger">*</span></h5>
                        <div class="controls">
                            <select name="group_id" required="" class="form-control">
                                <option value="" selected="" disabled="">Select Group</option>

                                @foreach ($groups as $group)
                                <option value="{{ $group->id }}" {{ ($editData->group_id == $group->id) ? 'selected' : '' }}>{{ $group->name }}</option>
                                @endforeach

                            </select>
                        </div>
                    </div>
                </div> <!-- End Col-4 -->


                <div class="col-md-4">
                    <div class="form-group">
                        <h5>Shift <span class="text-danger">*</span></h5>
                        <div class="controls">
                            <select name="shift_id" required="" class="form-control">
                                <option value="" selected="" disabled="">Select Shift</option>

                                @foreach ($shifts as $shift)
                                    <option value="{{ $shift->id }}" {{ ($editData->shift_id == $shift->id) ? 'selected' : '' }}>{{ $shift->name }}</option>
                                @endforeach
                                
                            </select>
                        </div>
                    </div>
                </div> <!-- End Col-4 -->


            </div> <!-- End Row -->
        


            <div class="text-xs-right">
                <input type="submit" class="btn btn-rounded btn-info mb-5" value="Promotion">
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


<script type="text/javascript">
    $(document).ready(function(){
        $('#image').change(function(e){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#showImage').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });
</script>

@endsection 