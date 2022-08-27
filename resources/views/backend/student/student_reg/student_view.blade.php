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
            <!-- Search form -->
            <div class="col-12">
                <form action="{{ route('student.year.class.wise') }}" method="GET">
                    <div class="box bb-3 border-warning">
                        <div class="box-header">
                        <h4 class="box-title">Student Search</h4>
                        </div>

                        <div class="box-body">
                            <div class="row">

                                <div class="col-4">
                                    <div class="form-group">
                                        <h5>Year <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <select name="year_id" id="year_id" required class="form-control">
                                                <option value="" disabled selected>Select Year</option>
                                                @foreach($years as $year)
                                                <option value="{{ $year->id }}" {{ ($year->id == $year_id) ? 'selected' : '' }}>{{ $year->name }}</option>
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
                                                <option value="{{ $class->id }}" {{ ($class->id == $class_id) ? 'selected' : '' }}>{{ $class->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-4">
                                    <div class="form-group" style="margin-top: 25px;">
                                        <input type="submit" class="btn btn-rounded btn-dark" name="search" value="Search">
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <!-- End Search form -->

          <div class="col-12">

           <div class="box">
              <div class="box-header with-border">
                <h3 class="box-title">Student List</h3>
                <a href="{{ route('student.reg.add') }}" class="btn btn-rounded btn-success float-right">Add Student</a>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                  <div class="table-responsive">
                    @if(!isset($_REQUEST['search']))
                    <table id="example1" class="table table-bordered table-striped">
                      <thead>
                          <tr>
                              <th width="5%">SL</th>
                              <th>Name</th>
                              <th>ID No</th>
                              <th>Roll</th>
                              <th>Year</th>
                              <th>Class</th>
                              <th>Image</th>
                              @if(Auth::user()->role == 'Admin')
                              <th>Code</th>
                              @endif
                              <th width="20%">Action</th>
                          </tr>
                      </thead>
                      <tbody>
                        @foreach($all_data as $data)
                          <tr>
                              <td>{{ $loop->index + 1 }}</td>
                              <td>{{ $data->student->name }}</td>
                              <td>{{ $data->student->id_no }}</td>
                              <td>{{ $data->roll }}</td>
                              <td>{{ $data->student_year->name }}</td>
                              <td>{{ $data->student_class->name }}</td>
                              <td>
                                <img src=" {{ (!empty($data->student->profile_photo_path)) ? URL::to('upload/student_images/'.$data->student->profile_photo_path) : URL::to('backend/images/user3-128x128.jpg') }} " alt="" style="width: 60px; height: 60px;">
                              </td>
                              @if(Auth::user()->role == 'Admin')
                              <td>{{ $data->student->code }}</td>
                              @endif
                              <td>
                                <a href="{{ route('student.reg.edit', $data->student_id) }}" class="btn btn-rounded btn-info btn-sm">Edit</a>
                                <a href="{{ route('student.reg.promotion', $data->student_id) }}" class="btn btn-rounded btn-danger btn-sm">Promotion</a>
                                <a target="_blank" href="{{ route('student.reg.details', $data->student_id) }}" class="btn btn-rounded btn-danger btn-sm">Details</a>
                              </td>
                          </tr>
                        @endforeach
                      </tbody>
                    </table>
                    @else
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th width="5%">SL</th>
                                <th>Name</th>
                                <th>ID No</th>
                                <th>Roll</th>
                                <th>Year</th>
                                <th>Class</th>
                                <th>Image</th>
                                @if(Auth::user()->role == 'Admin')
                                <th>Code</th>
                                @endif
                                <th width="20%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                          @foreach($all_data as $data)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $data->student->name }}</td>
                                <td>{{ $data->student->id_no }}</td>
                                <td>{{ $data->roll }}</td>
                                <td>{{ $data->student_year->name }}</td>
                                <td>{{ $data->student_class->name }}</td>
                                <td>
                                  <img src=" {{ (!empty($data->student->profile_photo_path)) ? URL::to('upload/student_images/'.$data->student->profile_photo_path) : URL::to('backend/images/user3-128x128.jpg') }} " alt="" style="width: 60px; height: 60px;">
                                </td>
                                @if(Auth::user()->role == 'Admin')
                                <td>{{ $data->student->code }}</td>
                                @endif
                                <td>
                                  <a href="{{ route('student.reg.edit', $data->student_id) }}" class="btn btn-rounded btn-info btn-sm">Edit</a>
                                  <a href="{{ route('student.reg.promotion', $data->student_id) }}" class="btn btn-rounded btn-danger btn-sm">Promotion</a>
                                  <a target="_blank" href="{{ route('student.reg.details', $data->student_id) }}" class="btn btn-rounded btn-danger btn-sm">Details</a>
                                </td>
                            </tr>
                          @endforeach
                        </tbody>
                      </table>
                    @endif
                  </div>
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
