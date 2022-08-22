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
                  <h3 class="page-title">Users</h3>
                  <div class="d-inline-block align-items-center">
                      <nav>
                          <ol class="breadcrumb">
                              <li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
                              <li class="breadcrumb-item" aria-current="page">Tables</li>
                              <li class="breadcrumb-item active" aria-current="page">Users</li>
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
                <h3 class="box-title">Manage Profile</h3>
                <a href="{{ route('view.profile') }}" class="btn btn-rounded btn-success float-right">View Profile</a>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <div class="row">
                  <div class="col">
                      <form novalidate method="POST" action="{{ route('update.profile', $data->id) }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <h5>Name <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="name" class="form-control" required data-validation-required-message="This field is required" value="{{ $data->name }}"> </div>
                                </div>
                                <div class="form-group">
                                    <h5>Mobile <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="mobile" class="form-control" required data-validation-required-message="This field is required" value="{{ $data->mobile }}"> </div>
                                </div>
                                <div class="form-group">
                                    <h5>Select Gender <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <select name="gender" id="gender" required class="form-control">
                                            <option value="" disabled selected>Select Gender</option>
                                            <option value="Male" {{ ($data->user_type=='Male')? 'selected' : '' }}>Male</option>
                                            <option value="Female" {{ ($data->user_type=='Female')? 'selected' : '' }}>Female</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <h5>Email <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="email" name="email" class="form-control" required data-validation-required-message="This field is required" value="{{ $data->email }}"> </div>
                                </div>
                                <div class="form-group">
                                    <h5>Address <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="address" class="form-control" required data-validation-required-message="This field is required" value="{{ $data->address }}"> </div>
                                </div>
                                <div class="form-group">
                                    <h5>Profile Photo <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="file" name="profile_photo_path" class="form-control" required data-validation-required-message="This field is required" id="image"> </div>
                                </div>
                                <div class="form-group">
                                    <img id="showImage" src=" {{ (!empty($data->profile_photo_path)) ? URL::to('upload/user_images/'.$data->profile_photo_path) : URL::to('backend/images/user3-128x128.jpg') }} " alt="" style="width: 100px; height: 100px;">
                                </div>
                            </div>
                            <div class="col-6">
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
