@extends('admin.admin_master')

@section('admin')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <div class="container-full">
      <!-- Content Header (Page header) -->
      <div class="content-header">
          <div class="d-flex align-items-center">
              <div class="mr-auto">
                  <h3 class="page-title">Assign Subject</h3>
                  <div class="d-inline-block align-items-center">
                      <nav>
                          <ol class="breadcrumb">
                              <li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
                              <li class="breadcrumb-item" aria-current="page">Tables</li>
                              <li class="breadcrumb-item active" aria-current="page">Assign Subject</li>
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
                <h3 class="box-title">Assign Subject Detials</h3>
                <a href="{{ route('view.assign.subject') }}" class="btn btn-rounded btn-success float-right">View Assign Subject</a>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                    <h4><strong>Assign Subject: </strong>{{ $all_data[0]->student_class->name }}</h4>
                  <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                      <thead>
                          <tr>
                              <th width="5%">SL</th>
                              <th>Subject</th>
                              <th>Full Mark</th>
                              <th>Pass Mark</th>
                              <th>Subjective Mark</th>
                          </tr>
                      </thead>
                      <tbody>
                        @foreach($all_data as $data)
                          <tr>
                              <td>{{ $loop->index + 1 }}</td>
                              <td>{{ $data->school_subject->name }}</td>
                              <td>{{ $data->full_mark }}</td>
                              <td>{{ $data->pass_mark }}</td>
                              <td>{{ $data->subjective_mark }}</td>
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
