@extends('admin.admin_master')

@section('admin')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <div class="container-full">
      <!-- Content Header (Page header) -->
      <div class="content-header">
          <div class="d-flex align-items-center">
              <div class="mr-auto">
                  <h3 class="page-title">Marks Grade</h3>
                  <div class="d-inline-block align-items-center">
                      <nav>
                          <ol class="breadcrumb">
                              <li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
                              <li class="breadcrumb-item" aria-current="page">Tables</li>
                              <li class="breadcrumb-item active" aria-current="page">Marks Grade</li>
                          </ol>
                      </nav>
                  </div>
              </div>
          </div>
      </div>

      <!-- Main content -->
      <section class="content">
        <div class="row">

          <div class="col-12">

           <div class="box">
              <div class="box-header with-border">
                <h3 class="box-title">Add Student Marks Grade</h3>
                <a href="{{ route('view.grade.marks') }}" class="btn btn-rounded btn-success float-right">View Student Marks Grade</a>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <div class="row">
                  <div class="col">
                      <form novalidate method="POST" action="{{ route('marks.grade.store') }}">
                        @csrf
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <h5>Grade Name <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="grade_name" class="form-control" required data-validation-required-message="This field is required"> </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <h5>Grade Point <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="grade_point" class="form-control" required data-validation-required-message="This field is required"> </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <h5>Start Marks <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="start_marks" class="form-control" required data-validation-required-message="This field is required"> </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <h5>End Marks <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="end_marks" class="form-control" required data-validation-required-message="This field is required"> </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <h5>Start Point <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="start_point" class="form-control" required data-validation-required-message="This field is required"> </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <h5>End Point <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="end_point" class="form-control" required data-validation-required-message="This field is required"> </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <h5>Remarks <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="remarks" class="form-control" required data-validation-required-message="This field is required"> </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                   <input type="submit" class="btn btn-rounded btn-primary" value="Add New">
                                </div>
                            </div>
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
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </section>
      <!-- /.content -->

    </div>
</div>
@endsection
