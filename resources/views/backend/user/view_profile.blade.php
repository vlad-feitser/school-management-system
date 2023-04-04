@extends('admin.admin_master')
@section('admin')


<div class="content-wrapper">
    <div class="container-full">
      <!-- Content Header (Page header) -->

      <!-- Main content -->
      <section class="content">
        <div class="row">

          <div class="col-12">

            <div class="box box-widget widget-user">
                <!-- Add the bg color to the header using any of the bg-* classes -->
                <div class="widget-user-header bg-black">
                    
                    <h3 class="widget-user-username">User Name: {{ auth()->user()->name }}</h3>
                    <a href="{{route('profile.edit')}}" style="float:right;" class="btn btn-rounded btn-success mr-5"> Edit Profile </a>
                    <h6 class="mt-10 widget-user-desc">User Email: {{ auth()->user()->email }}</h6>
                    <h6 class="mt-15 widget-user-desc">Role: {{ auth()->user()->usertype }}</h6>
                  
                </div>
                <div class="text-center">
                  <img style="border: 1px solid #ffffff;" class="rounded-circle h-300 mb-30"
                  src="{{ (!empty(auth()->user()->image)) ? url('upload/user_images/'.auth()->user()->image) : url('upload/no_image.jpg') }}" alt="User Avatar">
                </div>
                <div class="box-footer">
                  <div class="row">
                    <div class="col-sm-4">
                      <div class="description-block">
                        <h5 class="description-header">Mobile No</h5>
                        <span class="description-text">{{ auth()->user()->mobile }}</span>
                      </div>
                      <!-- /.description-block -->
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-4 br-1 bl-1">
                      <div class="description-block">
                        <h5 class="description-header">Address</h5>
                        <span class="description-text">{{ auth()->user()->address }}</span>
                      </div>
                      <!-- /.description-block -->
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-4">
                      <div class="description-block">
                        <h5 class="description-header">Gender</h5>
                        <span class="description-text">{{ auth()->user()->gender }}</span>
                      </div>
                      <!-- /.description-block -->
                    </div>
                    <!-- /.col -->
                  </div>
                  <!-- /.row -->
                </div>
              </div>

          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </section>
      <!-- /.content -->
    
    </div>
</div>


@endsection 