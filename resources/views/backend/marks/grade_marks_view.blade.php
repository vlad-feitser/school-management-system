@extends('admin.admin_master')
@section('admin')


<div class="content-wrapper">
    <div class="container-full">
      <!-- Content Header (Page header) -->

      <!-- Main content -->
      <section class="content">
        <div class="row">

          <div class="col-12">

           <div class="box">
              <div class="box-header with-border">
                <h3 class="box-title">Grade Marks List</h3>
                
                <a href="{{route('marks.grade.add')}}" style="float:right;" class="btn btn-rounded btn-success mb-5 mr-20"> Add Grade Mark </a>

              </div>
              <!-- /.box-header -->
              <div class="box-body">
                  <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
              <thead>
                  <tr>
                      <th width="5%">SL</th>
                      <th>Grade Name</th>
                      <th>Grade Point</th>
                      <th>Start Marks</th>
                      <th>End Marks</th>
                      <th>Point Range</th>
                      <th>Remarks</th>

                      <th class="text-center" width="18%">Action</th>
                  </tr>
              </thead>
              <tbody>
                @foreach ($allData as $key => $value)
                  <tr>
                    <td>{{ $key+1 }}</td>
                    <td>{{ $value->grade_name }}</td>
                    <td>{{ number_format((float)$value->grade_point,2) }}</td>
                    <td>{{ $value->start_marks }}</td>
                    <td>{{ $value->end_marks }}</td>
                    <td>{{ $value->start_point }} - {{ $value->end_point }}</td>
                    <td>{{ $value->remarks }}</td>

                    <td class="text-center">
                      <a href="{{route('marks.grade.edit', $value->id)}}" class="btn btn-info mr-15">Edit</a>
                      <a href="{{route('marks.grade.delete', $value->id)}}" class="btn btn-danger" id="delete">Delete</a>
                    </td>
                  </tr>
                @endforeach
                  
              </tbody>
                      <tfoot>
                          
                      </tfoot>
                    </table>
                  </div>
              </div>
              <!-- /.box-body -->
            </div>
            <!-- /.box -->        
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </section>
      <!-- /.content -->
    
    </div>
</div>


@endsection 