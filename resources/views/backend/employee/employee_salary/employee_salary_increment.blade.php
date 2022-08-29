@extends('admin.admin_master')

@section('admin')
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
                <h3 class="box-title">Employee Salary Incement</h3>
                <a href="{{ route('view.employee.salary') }}" class="btn btn-rounded btn-success float-right">View Employee Salary</a>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <div class="row">
                  <div class="col">
                      <form novalidate method="POST" action="{{ route('employee.increment.salary.update', $data->id) }}">
                        @csrf
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <h5>Salary Amount <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="icrement_salary" class="form-control" required data-validation-required-message="This field is required"> </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <h5>Effected Salary <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="date" name="effected_salary" class="form-control" required data-validation-required-message="This field is required"> </div>
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
@endsection
