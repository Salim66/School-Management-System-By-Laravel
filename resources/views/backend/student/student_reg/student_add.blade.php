@extends('admin.admin_master')

@section('admin')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <div class="container-full">
      <!-- Content Header (Page header) -->
      <div class="content-header">
          <div class="d-flex align-items-center">
              <div class="mr-auto">
                  <h3 class="page-title">Student</h3>
                  <div class="d-inline-block align-items-center">
                      <nav>
                          <ol class="breadcrumb">
                              <li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
                              <li class="breadcrumb-item" aria-current="page">Tables</li>
                              <li class="breadcrumb-item active" aria-current="page">Student</li>
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
                <h3 class="box-title">Register New Student</h3>
                <a href="{{ route('view.student.reg') }}" class="btn btn-rounded btn-success float-right">View Student Year</a>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <div class="row">
                  <div class="col">
                      <form novalidate method="POST" action="{{ route('student.year.store') }}">
                        @csrf
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <h5>Student Name <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="name" class="form-control" required data-validation-required-message="This field is required"> </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <h5>Father Name <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="fname" class="form-control" required data-validation-required-message="This field is required"> </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <h5>Mother Name <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="mname" class="form-control" required data-validation-required-message="This field is required"> </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <h5>Mobile Number <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="number" name="mobile" class="form-control" required data-validation-required-message="This field is required"> </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <h5>Address <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="address" class="form-control" required data-validation-required-message="This field is required"> </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <h5>Select Gender <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <select name="gender" id="gender" required class="form-control">
                                            <option value="" disabled selected>Select Gender</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <h5>Religion <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <select name="religion" id="religion" required class="form-control">
                                            <option value="" disabled selected>Select Religion</option>
                                            <option value="Islam">Islam</option>
                                            <option value="Hindu">Hindu</option>
                                            <option value="Crishtan">Crishtan</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <h5>Date of birth <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="date" name="dob" class="form-control" required data-validation-required-message="This field is required"> </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <h5>Discount <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="discount" class="form-control" required data-validation-required-message="This field is required"> </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <h5>Year <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <select name="gender" id="gender" required class="form-control">
                                            <option value="" disabled selected>Select Year</option>
                                            @foreach($years as $year)
                                            <option value="{{ $year->id }}">{{ $year->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <h5>Class <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <select name="gender" id="gender" required class="form-control">
                                            <option value="" disabled selected>Select Class</option>
                                            @foreach($classes as $class)
                                            <option value="{{ $class->id }}">{{ $class->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <h5>Group <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <select name="gender" id="gender" required class="form-control">
                                            <option value="" disabled selected>Select Group</option>
                                            @foreach($groups as $group)
                                            <option value="{{ $group->id }}">{{ $group->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
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
<!-- /.content-wrapper -->
@endsection
