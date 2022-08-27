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
                <h3 class="box-title">Edit Student</h3>
                <a href="{{ route('view.student.reg') }}" class="btn btn-rounded btn-success float-right">View Student Year</a>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <div class="row">
                  <div class="col">
                      <form novalidate method="POST" action="{{ route('student.reg.update', $data->student_id) }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{ $data->id }}">
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <h5>Student Name <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="name" class="form-control" required data-validation-required-message="This field is required" value="{{ $data->student->name }}"> </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <h5>Father Name <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="fname" class="form-control" required data-validation-required-message="This field is required" value="{{ $data->student->fname }}"> </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <h5>Mother Name <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="mname" class="form-control" required data-validation-required-message="This field is required" value="{{ $data->student->mname }}"> </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <h5>Mobile Number <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="number" name="mobile" class="form-control" required data-validation-required-message="This field is required" value="{{ $data->student->mobile }}"> </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <h5>Address <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="address" class="form-control" required data-validation-required-message="This field is required" value="{{ $data->student->address }}"> </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <h5>Select Gender <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <select name="gender" id="gender" required class="form-control">
                                            <option value="" disabled selected>Select Gender</option>
                                            <option value="Male" {{ ($data->student->gender == 'Male') ? 'selected' : '' }}>Male</option>
                                            <option value="Female" {{ ($data->student->gender == 'Female') ? 'selected' : '' }}>Female</option>
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
                                            <option value="Islam" {{ ($data->student->religion == 'Islam') ? 'selected' : '' }}>Islam</option>
                                            <option value="Hindu" {{ ($data->student->religion == 'Hindu') ? 'selected' : '' }}>Hindu</option>
                                            <option value="Crishtan" {{ ($data->student->religion == 'Crishtan') ? 'selected' : '' }}>Crishtan</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <h5>Date of birth <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="date" name="dob" class="form-control" required data-validation-required-message="This field is required" value="{{ $data->student->dob }}"> </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <h5>Discount <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="discount" class="form-control" required data-validation-required-message="This field is required" value="{{ $data->discount->discount }}"> </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <h5>Year <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <select name="year_id" id="year_id" required class="form-control">
                                            <option value="" disabled selected>Select Year</option>
                                            @foreach($years as $year)
                                            <option value="{{ $year->id }}" {{ $data->year_id == $year->id ? 'selected' : '' }}>{{ $year->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <h5>Class <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <select name="class_id" id="class_id" required class="form-control">
                                            <option value="" disabled selected>Select Class</option>
                                            @foreach($classes as $class)
                                            <option value="{{ $class->id }}" {{ $data->class_id == $class->id ? 'selected' : '' }}>{{ $class->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <h5>Group <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <select name="group_id" id="group_id" required class="form-control">
                                            <option value="" disabled selected>Select Group</option>
                                            @foreach($groups as $group)
                                            <option value="{{ $group->id }}" {{ $data->group_id == $group->id ? 'selected' : '' }}>{{ $group->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <h5>Shift <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <select name="shift_id" id="shift_id" required class="form-control">
                                            <option value="" disabled selected>Select Shift</option>
                                            @foreach($shifts as $shift)
                                            <option value="{{ $shift->id }}" {{ $data->shift_id == $shift->id ? 'selected' : '' }}>{{ $shift->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <h5>Profile Photo <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="file" name="profile_photo_path" class="form-control" required data-validation-required-message="This field is required" id="image"> </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <img id="showImage" src=" {{ (isset($data->student->profile_photo_path) && !empty($data->student->profile_photo_path)) ? URL::to('upload/student_images/'.$data->student->profile_photo_path) : URL::to('backend/images/user3-128x128.jpg') }} " alt="" style="width: 100px; height: 100px;">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                   <input type="submit" class="btn btn-rounded btn-primary" value="Update">
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
