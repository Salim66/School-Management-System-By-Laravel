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
                  <h3 class="page-title">Student Result</h3>
                  <div class="d-inline-block align-items-center">
                      <nav>
                          <ol class="breadcrumb">
                              <li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
                              <li class="breadcrumb-item" aria-current="page">Tables</li>
                              <li class="breadcrumb-item active" aria-current="page">Student Result</li>
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
                <form action="{{ route('student.resutl.get') }}" method="GET" target="_blank">
                    @csrf
                    <div class="box bb-3 border-warning">
                        <div class="box-header">
                        <h4 class="box-title">Manage Student Result View</h4>
                        </div>

                        <div class="box-body">
                            <div class="row">

                                <div class="col-3">
                                    <div class="form-group">
                                        <h5>Year <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <select name="year_id" id="year_id" required class="form-control">
                                                <option value="" disabled selected>Select Year</option>
                                                @foreach($years as $year)
                                                <option value="{{ $year->id }}" >{{ $year->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <h5>Class <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <select name="class_id" id="class_id" required class="form-control">
                                                <option value="" disabled selected>Select Class</option>
                                                @foreach($classes as $class)
                                                <option value="{{ $class->id }}" >{{ $class->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <h5>Exam Type <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <select name="exam_type_id" id="exam_type_id" required class="form-control">
                                                <option value="" disabled selected>Select Exam Type</option>
                                                @foreach($exam_types as $type)
                                                <option value="{{ $type->id }}" >{{ $type->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
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
