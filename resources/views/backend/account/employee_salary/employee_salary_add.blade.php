@extends('admin.admin_master')

@section('admin')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/4.7.7/handlebars.min.js"></script>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <div class="container-full">
      <!-- Content Header (Page header) -->
      <div class="content-header">
          <div class="d-flex align-items-center">
              <div class="mr-auto">
                  <h3 class="page-title">Employee Salary</h3>
                  <div class="d-inline-block align-items-center">
                      <nav>
                          <ol class="breadcrumb">
                              <li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
                              <li class="breadcrumb-item" aria-current="page">Tables</li>
                              <li class="breadcrumb-item active" aria-current="page">Employee Salary</li>
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
                        <h4 class="box-title">Account Employee Salary</h4>
                        </div>

                        <div class="box-body">
                            <div class="row">

                                <div class="col-6">
                                    <div class="form-group">
                                        <h5>Date <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="date" name="date" id="date" class="form-control" required data-validation-required-message="This field is required"> </div>
                                    </div>
                                </div>

                                <div class="col-6" style="margin-top: 25px;">
                                    <div class="form-group">
                                        <a id="search" class="btn btn-primary" name="search">Search</a>
                                    </div>
                                </div>

                            </div>

                             <!--- ///////////////////////// Studnet Registration Fee ///////////////////////// --->
                             <div class="row">
                                <div class="col-md-12">
                                    <div id="DocumentResults">

                                <script id="document-template" type="text/x-handlebars-template">
                                    <form action="{{ route('student.fee.store') }}" method="POST">
                                        @csrf
                                        <table class="table table-bordered table-striped" style="width: 100%">
                                        <thead>
                                            <tr>
                                        @{{{thsource}}}
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @{{#each this}}
                                            <tr>
                                                @{{{tdsource}}}
                                            </tr>
                                            @{{/each}}
                                        </tbody>
                                        </table>
                                        <button type="submit" class="btn btn-success">Submit</button>
                                    </form>
                               </script>



                                    </div>
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

<script type="text/javascript">
    $(document).on('click','#search',function(){
      let date = $('#date').val();
       $.ajax({
        url: "{{ route('employee.salary.getemployee') }}",
        type: "get",
        data: {'date':date},
        beforeSend: function() {
        },
        success: function (data) {
          var source = $("#document-template").html();
          var template = Handlebars.compile(source);
          var html = template(data);
          $('#DocumentResults').html(html);
          $('[data-toggle="tooltip"]').tooltip();
        }
      });
    });
  </script>
@endsection
