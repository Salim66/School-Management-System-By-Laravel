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
                <h3 class="box-title">Create Employee Attendance</h3>
                <a href="{{ route('view.employee.attendance') }}" class="btn btn-rounded btn-success float-right">View Employee Attendance List</a>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <div class="row">
                  <div class="col">
                      <form novalidate method="POST" action="{{ route('designation.store') }}">
                        @csrf
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <h5>Date <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="date" name="date" class="form-control" required data-validation-required-message="This field is required"> </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <table class="table table-bordered table-striped" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th rowspan="2" class="text-center" style="vertical-align: middle">SL</th>
                                            <th rowspan="2" class="text-center" style="vertical-align: middle">Employee List</th>
                                            <th colspan="3" class="text-center" style="vertical-align: middle; width: 30%;">Attendance Status</th>
                                        </tr>
                                        <tr>
                                            <th class="text-center btn present_all" style="display: table-cell; background-color: #000000;">Present</th>
                                            <th class="text-center btn present_all" style="display: table-cell; background-color: #000000;">Leave</th>
                                            <th class="text-center btn present_all" style="display: table-cell; background-color: #000000;">Absent</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>SL</td>
                                            <td>Employee List</td>
                                            <td colspan="3">
                                                <div class="switch-toggle switch-3 switch-candy">
                                                    <input name="group1" type="radio" id="radio_1" checked="">
                                                    <label for="radio_1">Present</label>

                                                    <input name="group2" type="radio" id="radio_2" >
                                                    <label for="radio_2">Leave</label>

                                                    <input name="group3" type="radio" id="radio_3">
                                                    <label for="radio_3">Absent</label>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
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
