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
                <h3 class="box-title">Create Fee Amount</h3>
                <a href="{{ route('view.fee.amount') }}" class="btn btn-rounded btn-success float-right">View Fee Amount</a>
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
                                        <h5>Fee Category <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <select name="fee_category_id" id="fee_category_id" required class="form-control">
                                                <option value="" disabled selected>Select Fee Category</option>
                                                @foreach($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-5">
                                            <div class="form-group">
                                                <h5>Student Class <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <select name="class_id" id="class_id" required class="form-control">
                                                        <option value="" disabled selected>Select Student Class</option>
                                                        @foreach($classes as $class)
                                                        <option value="{{ $class->id }}">{{ $class->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-5">
                                            <div class="form-group">
                                                <h5>Fee Amount <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="number" name="amount" class="form-control" required data-validation-required-message="This field is required"> </div>
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
                <div class="col-5">
                    <div class="form-group">
                        <h5>Student Class <span class="text-danger">*</span></h5>
                        <div class="controls">
                            <select name="class_id" id="class_id" required class="form-control">
                                <option value="" disabled selected>Select Student Class</option>
                                @foreach($classes as $class)
                                <option value="{{ $class->id }}">{{ $class->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-5">
                    <div class="form-group">
                        <h5>Fee Amount <span class="text-danger">*</span></h5>
                        <div class="controls">
                            <input type="number" name="amount" class="form-control" required data-validation-required-message="This field is required"> </div>
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
        let counter = 0;
        $(document).on('click', '.addeventmore', function(){
            let whole_extra_item_add = $('#whole_extra_item_add').html();
            $('.add_item').append(whole_extra_item_add);
            counter++;
        });
        $(document).on('click', '.removeeventmore', function(){
            $('#delete_whole_extra_item_add').remove()
            counter--;
        });
    });
</script>

@endsection
