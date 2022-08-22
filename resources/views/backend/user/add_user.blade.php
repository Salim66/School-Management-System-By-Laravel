@extends('admin.admin_master')

@section('admin')
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
                <h3 class="box-title">Create User</h3>
                <a href="{{ route('user.view') }}" class="btn btn-rounded btn-success float-right">View User</a>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <div class="row">
                  <div class="col">
                      <form novalidate method="POST" action="{{ route('user.store') }}">
                        @csrf
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <h5>Select Role <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <select name="user_type" id="user_type" required class="form-control">
                                            <option value="" disabled selected>Select Role</option>
                                            <option value="Admin">Admin</option>
                                            <option value="User">User</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <h5>Name <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="name" class="form-control" required data-validation-required-message="This field is required"> </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <h5>Email <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="email" name="email" class="form-control" required data-validation-required-message="This field is required"> </div>
                                </div>
                                <div class="form-group">
                                    <h5>Password <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="password" name="password" class="form-control" required data-validation-required-message="This field is required"> </div>
                                </div>
                            </div>
                            <div class="col-6">
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
