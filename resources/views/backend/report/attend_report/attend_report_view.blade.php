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
                  <h3 class="page-title">Attandance Report</h3>
                  <div class="d-inline-block align-items-center">
                      <nav>
                          <ol class="breadcrumb">
                              <li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
                              <li class="breadcrumb-item" aria-current="page">Tables</li>
                              <li class="breadcrumb-item active" aria-current="page">Attandance Report</li>
                          </ol>
                      </nav>
                  </div>
              </div>
          </div>
      </div>

      <!-- Main content -->
      <section class="content">
        <div class="row">
            <!-- Search form -->
            <div class="col-12">
                <form action="{{ route('atten.report.get') }}" method="GET" target="_blank">
                    @csrf
                    <div class="box bb-3 border-warning">
                        <div class="box-header">
                        <h4 class="box-title">Manage Attandance Report</h4>
                        </div>

                        <div class="box-body">
                            <div class="row">

                                <div class="col-3">
                                    <div class="form-group">
                                        <h5>Employee Name <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <select name="employee_id" id="employee_id" required class="form-control">
                                                <option value="" disabled selected>Select Name</option>
                                                @foreach($employees as $employee)
                                                <option value="{{ $employee->id }}" >{{ $employee->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <h5>Date <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="date" name="date" class="form-control" required data-validation-required-message="This field is required"> </div>
                                    </div>
                                </div>

                                <div class="col-3" style="margin-top: 25px;">
                                    <div class="form-group">
                                        <input type="submit" class="btn btn-primary" value="Search">
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>

                </form>
            </div>
            <!-- End Search form -->
        </div>
        <!-- /.row -->
      </section>
      <!-- /.content -->

    </div>
</div>
<!-- /.content-wrapper -->
@endsection
