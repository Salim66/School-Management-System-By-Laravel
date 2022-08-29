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
                  <h3 class="page-title">Employee</h3>
                  <div class="d-inline-block align-items-center">
                      <nav>
                          <ol class="breadcrumb">
                              <li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
                              <li class="breadcrumb-item" aria-current="page">Tables</li>
                              <li class="breadcrumb-item active" aria-current="page">Employee</li>
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
                <h3 class="box-title">Register New Employee</h3>
                <a href="{{ route('view.employee.reg') }}" class="btn btn-rounded btn-success float-right">View Employee</a>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <div class="row">
                  <div class="col">
                      <form novalidate method="POST" action="{{ route('employee.reg.update', $data->id) }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <h5>Employee Name <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="name" class="form-control" required data-validation-required-message="This field is required" value="{{ $data->name }}"> </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <h5>Father Name <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="fname" class="form-control" required data-validation-required-message="This field is required" value="{{ $data->fname }}"> </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <h5>Mother Name <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="mname" class="form-control" required data-validation-required-message="This field is required" value="{{ $data->mname }}"> </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <h5>Mobile Number <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="number" name="mobile" class="form-control" required data-validation-required-message="This field is required" value="{{ $data->mobile }}"> </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <h5>Address <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="address" class="form-control" required data-validation-required-message="This field is required" value="{{ $data->address }}"> </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <h5>Select Gender <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <select name="gender" id="gender" required class="form-control">
                                            <option value="" disabled selected>Select Gender</option>
                                            <option value="Male" {{ ($data->gender == 'Male') ? 'selected' : '' }}>Male</option>
                                            <option value="Female" {{ ($data->gender == 'Female') ? 'selected' : '' }}>Female</option>
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
                                            <option value="Islam" {{ ($data->religion == 'Islam') ? 'selected' : '' }}>Islam</option>
                                            <option value="Hindu" {{ ($data->religion == 'Hindu') ? 'selected' : '' }}>Hindu</option>
                                            <option value="Crishtan" {{ ($data->religion == 'Crishtan') ? 'selected' : '' }}>Crishtan</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <h5>Date of birth <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="date" name="dob" class="form-control" required data-validation-required-message="This field is required" value="{{ $data->dob }}"> </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <h5>Designation <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <select name="designation_id" id="designation_id" required class="form-control">
                                            <option value="" disabled selected>Select Designation</option>
                                            @foreach($designations as $designation)
                                            <option value="{{ $designation->id }}" {{ ($data->designation_id == $designation->id) ? 'selected' : '' }}>{{ $designation->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            @if(!$data)
                            <div class="col-3">
                                <div class="form-group">
                                    <h5>Salary <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="salary" class="form-control" required data-validation-required-message="This field is required"  value="{{ $data->salary }}"> </div>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <h5>Joining Date <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="date" name="join_date" class="form-control" required data-validation-required-message="This field is required" value="{{ $data->join_date }}"> </div>
                                </div>
                            </div>
                            @endif
                            <div class="col-3">
                                <div class="form-group">
                                    <h5>Profile Photo <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="file" name="profile_photo_path" class="form-control" required data-validation-required-message="This field is required" id="image"> </div>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <img id="showImage" src=" {{ (!empty($data->profile_photo_path)) ? URL::to('upload/employee_images/'.$data->profile_photo_path) :  URL::to('backend/images/user3-128x128.jpg') }} " alt="" style="width: 100px; height: 100px;">
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
<script type="text/javascript">
    $(document).ready(function(){
        $("#image").change(function(e){
            let reader = new FileReader();
            reader.onload = function(e){
                $('#showImage').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files[0]);
        });
    });
</script>
@endsection
