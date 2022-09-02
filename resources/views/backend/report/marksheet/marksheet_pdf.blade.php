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
                  <h3 class="page-title">MarkSheet Generate</h3>
                  <div class="d-inline-block align-items-center">
                      <nav>
                          <ol class="breadcrumb">
                              <li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
                              <li class="breadcrumb-item" aria-current="page">Tables</li>
                              <li class="breadcrumb-item active" aria-current="page">MarkSheet Generate</li>
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
                <div class="box bb-3 border-warning">
                    <div class="box-header">
                    <h4 class="box-title">MarkSheet Generate PDF</h4>
                    </div>

                    <div class="box-body" style="border: 1px solid #ddd; padding: 10px;">

                        <div class="row">

                            <div class="col-md-2 text-center" style="float: right">
                                <img src="{{ URL::to('backend/images/logo/logo-3.jpg') }}" alt="">
                            </div>
                            <div class="col-md-2 text-center">

                            </div>
                            <div class="col-md-4 text-center" style="float: left; text-align: center;">
                                <h4><strong>Easy Learning School</strong></h4>
                                <h6><strong>Rangpur Bangladesh</strong></h6>
                                <h5><strong><u><i>Academic Transcript</i></u></strong></h5>
                                <h6><strong>{{ $all_marks[0]['exam_type']['name'] }}</strong></h6>
                            </div>
                            <div class="col-md-12">
                                <hr style="border: 1px solid; width: 100%; margin-bottom: 0px; color: #ddd;">
                                <p style="text-align: right;"><strong><u><i>Print Date: </i> {{ date('d M Y') }} </u></strong></p>
                            </div>

                        </div>

                        <div class="row">

                            <div class="col-md-6">

                                <table border="1" style="border-color: #FFFFFF;" width="100%" cellpadding="8" cellspacing="2">

                                    @php
                                        $assign_student = \App\Models\AssignStudent::where('year_id', $all_marks[0]['year_id'])->where('class_id', $all_marks[0]['class_id'])->first();
                                    @endphp

                                    <tr>
                                        <td width="50%">Student ID</td>
                                        <td width="50%">{{ $all_marks[0]['id_no'] }}</td>
                                    </tr>

                                    <tr>
                                        <td width="50%">Roll No</td>
                                        <td width="50%">{{ $assign_student->roll }}</td>
                                    </tr>

                                    <tr>
                                        <td width="50%">Name</td>
                                        <td width="50%">{{ $all_marks[0]['student']['name'] }}</td>
                                    </tr>

                                    <tr>
                                        <td width="50%">Class</td>
                                        <td width="50%">{{ $all_marks[0]['class']['name'] }}</td>
                                    </tr>

                                    <tr>
                                        <td width="50%">Session</td>
                                        <td width="50%">{{ $all_marks[0]['year']['name'] }}</td>
                                    </tr>

                                </table>

                            </div>

                            <div class="col-md-6">

                                <table border="1" style="border-color: #FFFFFF;" width="100%" cellpadding="8" cellspacing="2">

                                    <thead>
                                        <tr>
                                            <td>Letter Grade</td>
                                            <td>Marks Interval</td>
                                            <td>Grade Point</td>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($all_grades as $mark)
                                            <tr>
                                                <td>{{ $mark->grade_name }}</td>
                                                <td>{{ $mark->start_marks }} - {{ $mark->end_marks }}</td>
                                                <td>{{ number_format((float)$mark->grade_point,2) }} - {{ ($mark->grade_point == 5) ? (number_format((float)$mark->grade_point,2)) : (number_format((float)$mark->grade_point+1,2) - (float)0.01)}}</td>
                                            </tr>
                                        @endforeach

                                    </tbody>

                                </table>

                            </div>

                        </div>

                    </div>
                </div>
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
