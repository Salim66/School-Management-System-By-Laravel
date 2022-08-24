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
                  <h3 class="page-title">Fee Amount</h3>
                  <div class="d-inline-block align-items-center">
                      <nav>
                          <ol class="breadcrumb">
                              <li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
                              <li class="breadcrumb-item" aria-current="page">Tables</li>
                              <li class="breadcrumb-item active" aria-current="page">Fee Amount</li>
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
                <h3 class="box-title">Create Assign Subject</h3>
                <a href="{{ route('view.fee.amount') }}" class="btn btn-rounded btn-success float-right">View Assign Subject</a>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <div class="row">
                  <div class="col">
                      <form novalidate method="POST" action="{{ route('fee.amount.store') }}">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="add_item">

                                    <div class="form-group">
                                        <h5>Student Class <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <select name="class_id[]" id="class_id" required class="form-control">
                                                <option value="" disabled selected>Select Student Class</option>
                                                @foreach($classes as $class)
                                                <option value="{{ $class->id }}">{{ $class->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-4">
                                            <div class="form-group">
                                                <h5>Student Subject <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <select name="subject_id[]" id="subject_id" required class="form-control">
                                                        <option value="" disabled selected>Select Student Subject</option>
                                                        @foreach($subjects as $subject)
                                                        <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <div class="form-group">
                                                <h5>Full Mark <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="number" name="full_mark[]" class="form-control" required data-validation-required-message="This field is required"> </div>
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <div class="form-group">
                                                <h5>Pass Mark <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="number" name="pass_mark[]" class="form-control" required data-validation-required-message="This field is required"> </div>
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <div class="form-group">
                                                <h5>Subjective Mark <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="number" name="subjective_mark[]" class="form-control" required data-validation-required-message="This field is required"> </div>
                                            </div>
                                        </div>
                                        <div class="col-2" style="margin-top: 25px;">
                                            <span class="btn btn-success addeventmore"><i class="fa fa-plus-circle"></i></span>
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                           <input type="submit" class="btn btn-rounded btn-primary" value="Add New">
                                        </div>
                                    </div>
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

<!-- Add Close Contain -->
<div style="visibility: hidden;">
    <div class="whole_extra_item_add" id="whole_extra_item_add">
        <div class="delete_whole_extra_item_add" id="delete_whole_extra_item_add">
            <div class="form-row">
                <div class="col-4">
                    <div class="form-group">
                        <h5>Student Subject <span class="text-danger">*</span></h5>
                        <div class="controls">
                            <select name="subject_id[]" id="subject_id" required class="form-control">
                                <option value="" disabled selected>Select Student Subject</option>
                                @foreach($subjects as $subject)
                                <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-2">
                    <div class="form-group">
                        <h5>Full Mark <span class="text-danger">*</span></h5>
                        <div class="controls">
                            <input type="number" name="full_mark[]" class="form-control" required data-validation-required-message="This field is required"> </div>
                    </div>
                </div>
                <div class="col-2">
                    <div class="form-group">
                        <h5>Pass Mark <span class="text-danger">*</span></h5>
                        <div class="controls">
                            <input type="number" name="pass_mark[]" class="form-control" required data-validation-required-message="This field is required"> </div>
                    </div>
                </div>
                <div class="col-2">
                    <div class="form-group">
                        <h5>Subjective Mark <span class="text-danger">*</span></h5>
                        <div class="controls">
                            <input type="number" name="subjective_mark[]" class="form-control" required data-validation-required-message="This field is required"> </div>
                    </div>
                </div>
                <div class="col-2" style="margin-top: 25px;">
                    <span class="btn btn-success addeventmore"><i class="fa fa-plus-circle"></i></span>
                    <span class="btn btn-danger removeeventmore"><i class="fa fa-minus-circle"></i></span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Add Close Contain -->

<script type="text/javascript">
    $(document).ready(function(){
        var counter = 0;
        $(document).on("click",".addeventmore",function(){
            var whole_extra_item_add = $('#whole_extra_item_add').html();
            $(this).closest(".add_item").append(whole_extra_item_add);
            counter++;
        });
        $(document).on("click",'.removeeventmore',function(event){
            $(this).closest(".delete_whole_extra_item_add").remove();
            counter -= 1
        });
    });
</script>

@endsection
