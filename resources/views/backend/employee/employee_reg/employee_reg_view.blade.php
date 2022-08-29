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
                <h3 class="box-title">Employee Registration List</h3>
                <a href="{{ route('employee.reg.add') }}" class="btn btn-rounded btn-success float-right">Add Employee Registration</a>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                  <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                      <thead>
                          <tr>
                              <th width="5%">SL</th>
                              <th>Employee Name</th>
                              <th>ID No</th>
                              <th>Mobile</th>
                              <th>Gender</th>
                              <th>Join Date</th>
                              <th>Salary</th>
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
                              <td>{{ $data->name }}</td>
                              <td>{{ $data->id_no }}</td>
                              <td>{{ $data->mobile }}</td>
                              <td>{{ $data->gender }}</td>
                              <td>{{ $data->join_date }}</td>
                              <td>{{ $data->salary }}</td>
                              @if(Auth::user()->role == 'Admin')
                              <td>{{ $data->code }}</td>
                              @endif
                              <td>
                                <a href="{{ route('employee.reg.edit', $data->id) }}" class="btn btn-rounded btn-info btn-sm">Edit</a>
                                <a id="delete" href="{{ route('designation.delete', $data->id) }}" class="btn btn-rounded btn-danger btn-sm">Delete</a>
                              </td>
                          </tr>
                        @endforeach
                      </tbody>
                    </table>
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
