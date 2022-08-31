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
                  <h3 class="page-title">Student Marks</h3>
                  <div class="d-inline-block align-items-center">
                      <nav>
                          <ol class="breadcrumb">
                              <li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
                              <li class="breadcrumb-item" aria-current="page">Tables</li>
                              <li class="breadcrumb-item active" aria-current="page">Student Marks</li>
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
                <form action="{{ route('student.roll.store') }}" method="POST">
                    @csrf
                    <div class="box bb-3 border-warning">
                        <div class="box-header">
                        <h4 class="box-title">Student Search</h4>
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
                                        <h5>Subject <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <select name="assign_subject_id" id="assign_subject_id" required class="form-control">
                                                <option value="" disabled selected>Select Class</option>

                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-3">
                                    <div class="form-group" style="margin-top: 25px;">
                                        <a id="search" class="btn btn-primary" name="search">Search</a>
                                    </div>
                                </div>

                            </div>

                             <!--- ///////////////////////// Roll Generate ///////////////////////// --->
                            <div class="row d-none" id="roll_generate">
                                <div class="col-12">
                                    <table class="table table-bordered table-striped" style="width: 100%">
                                        <thead>
                                            <th>ID</th>
                                            <th>Student Name</th>
                                            <th>Father Name</th>
                                            <th>Gender</th>
                                            <th>Roll</th>
                                        </thead>
                                        <tbody id="roll_generate_tr">

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            {{-- <div class="d-inline-block">
                                <input type="submit" class="btn btn-info" value="Roll Generate">
                            </div> --}}

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
<script type="text/javascript">
    $(document).on('click', '#search', function(){
        let year_id = $("#year_id").val();
        let class_id = $("#class_id").val();
        $.ajax({
            url: "{{ route('student.registration.getstudents') }}",
            type: "GET",
            data: { 'year_id': year_id, 'class_id': class_id },
            success: function(data){
                $('#roll_generate').removeClass('d-none');
                let html = '';
                $.each( data, function(key, v){
                    html +=
                    '<tr>'+
                        '<td>'+v.student.id_no+'<input type="hidden" name="student_id[]" value="'+v.student_id+'"></td>'+
                        '<td>'+v.student.name+'</td>'+
                        '<td>'+v.student.fname+'</td>'+
                        '<td>'+v.student.gender+'</td>'+
                        '<td><input type="text" class="form-control form-control-sm" name="roll[]" value="'+v.roll+'"></td>'+
                    '</tr>';
                });
                html = $('#roll_generate_tr').html(html);
            }
        });
    });
</script>

<script src="text/javascript">
   $(function(){
    $(document).on('change', '#class_id', function(){
        let class_id = $('#class_id').val();
        $.ajax({
            url: "{{ route('marks.getSubject') }}",
            type: 'GET',
            data: { class_id: class_id },
            success: function(data){
                let html = "<option value="">Select Subject</option>";
                $.each(data , function(key, v){
                    html .= '<option value="'+v.id+'">'+v.school_subject->name+'</option>';
                });
                $('#assign_subject_id').html(html);
            }
        });
    });
   });
</script>
@endsection
