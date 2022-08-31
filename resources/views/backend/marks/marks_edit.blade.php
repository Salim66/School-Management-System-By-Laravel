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
                <form action="{{ route('marks.entry.update') }}" method="POST">
                    @csrf
                    <div class="box bb-3 border-warning">
                        <div class="box-header">
                        <h4 class="box-title">Edit Marks</h4>
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
                                                <option value="" disabled selected>Select Subject</option>

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

                                <div class="col-3">
                                    <div class="form-group">
                                        <a id="search" class="btn btn-primary" name="search">Search</a>
                                    </div>
                                </div>

                            </div>

                             <!--- ///////////////////////// Marks Generate ///////////////////////// --->
                            <div class="row d-none" id="marks_student">
                                <div class="col-12">
                                    <table class="table table-bordered table-striped" style="width: 100%">
                                        <thead>
                                            <th>ID</th>
                                            <th>Student Name</th>
                                            <th>Father Name</th>
                                            <th>Gender</th>
                                            <th>Marks</th>
                                        </thead>
                                        <tbody id="marks_student_tr">

                                        </tbody>
                                    </table>

                                    <div class="d-inline-block">
                                        <input type="submit" class="btn btn-info" value="Update">
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
<script type="text/javascript">
    $(document).on('click', '#search', function(){
        let year_id = $("#year_id").val();
        let class_id = $("#class_id").val();
        let assign_subject_id = $("#assign_subject_id").val();
        let exam_type_id = $("#exam_type_id").val();
        $.ajax({
            url: "{{ route('edit.entry.marks.getstudents') }}",
            type: "GET",
            data: { 'year_id': year_id, 'class_id': class_id, 'assign_subject_id': assign_subject_id, 'exam_type_id': exam_type_id },
            success: function(data){
                $('#marks_student').removeClass('d-none');
                let html = '';
                $.each( data, function(key, v){
                    html +=
                    '<tr>'+
                        '<td>'+v.student.id_no+'<input type="hidden" name="student_id[]" value="'+v.student_id+'"> <input type="hidden" name="id_no[]" value="'+v.student.id_no+'"> </td>'+
                        '<td>'+v.student.name+'</td>'+
                        '<td>'+v.student.fname+'</td>'+
                        '<td>'+v.student.gender+'</td>'+
                        '<td><input type="text" class="form-control form-control-sm" name="marks[]" value="'+v.marks+'"></td>'+
                    '</tr>';
                });
                html = $('#marks_student_tr').html(html);
            }
        });
    });
</script>

<!-- get student subject by class -->
<script type="text/javascript">
   $(function(){
        $(document).on('change', '#class_id', function(){
            let class_id = $(this).val();

            $.ajax({
                url: "{{ route('marks.getSubject') }}",
                type: 'GET',
                data: { class_id: class_id },
                success: function(data){
                    let html = '<option value="">Select Subject</option>';
                    $.each( data, function(key, v){
                        html += '<option value="'+v.id+'">'+v.school_subject.name+'</option>';
                    });
                    $('#assign_subject_id').html(html);
                }
            });
        });
   });
</script>
@endsection
