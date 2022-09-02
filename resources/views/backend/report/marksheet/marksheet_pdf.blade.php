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
