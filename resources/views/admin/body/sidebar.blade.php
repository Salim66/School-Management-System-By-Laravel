@php
    $prefix = Request::route()->getPrefix();
    $route = Route::current()->getName();
@endphp
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar-->
    <section class="sidebar">

        <div class="user-profile">
			<div class="ulogo">
				 <a href="index.html">
				  <!-- logo for regular state and mobile devices -->
					 <div class="d-flex align-items-center justify-content-center">
						  <img src="../images/logo-dark.png" alt="">
						  <h3><b>ERP</b> Admin</h3>
					 </div>
				</a>
			</div>
        </div>

      <!-- sidebar menu-->
      <ul class="sidebar-menu" data-widget="tree">

		<li class="{{ ($prefix == '/') ? 'active' : '' }}">
          <a href="{{ route('dashboard') }}">
            <i data-feather="pie-chart"></i>
			<span>Dashboard</span>
          </a>
        </li>

        @if(Auth::user()->role == 'Admin')
        <li class="treeview {{ ($prefix == '/users') ? 'active' : '' }}">
          <a href="#">
            <i data-feather="message-circle"></i>
            <span>Manage User</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{ ($route == 'user.view') ? 'active' : '' }}"><a href="{{ route('user.view') }}"><i class="ti-more"></i>View User</a></li>
            <li class="{{ ($route == 'user.add') ? 'active' : '' }}"><a href="{{ route('user.add') }}"><i class="ti-more"></i>Add User</a></li>
          </ul>
        </li>
        @endif

        <li class="treeview {{ ($prefix == '/profile') ? 'active' : '' }}">
          <a href="#">
            <i data-feather="message-circle"></i>
            <span>Manage Profile</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{ ($route == 'view.profile') ? 'active' : '' }}"><a href="{{ route('view.profile') }}"><i class="ti-more"></i>View Profile</a></li>
            <li class="{{ ($route == 'view.password') ? 'active' : '' }}"><a href="{{ route('view.password') }}"><i class="ti-more"></i>Change Password</a></li>
          </ul>
        </li>

        <li class="treeview {{ ($prefix == '/setups') ? 'active' : '' }}">
          <a href="#">
            <i data-feather="message-circle"></i>
            <span>Setup Management</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{ ($route == 'view.student.class') ? 'active' : '' }}"><a href="{{ route('view.student.class') }}"><i class="ti-more"></i>View Student Class</a></li>
            <li class="{{ ($route == 'view.student.year') ? 'active' : '' }}"><a href="{{ route('view.student.year') }}"><i class="ti-more"></i>View Student Year</a></li>
            <li class="{{ ($route == 'view.student.group') ? 'active' : '' }}"><a href="{{ route('view.student.group') }}"><i class="ti-more"></i>View Student Group</a></li>
            <li class="{{ ($route == 'view.student.shift') ? 'active' : '' }}"><a href="{{ route('view.student.shift') }}"><i class="ti-more"></i>View Student Shift</a></li>
            <li class="{{ ($route == 'view.fee.category') ? 'active' : '' }}"><a href="{{ route('view.fee.category') }}"><i class="ti-more"></i>View Fee Category</a></li>
            <li class="{{ ($route == 'view.fee.amount') ? 'active' : '' }}"><a href="{{ route('view.fee.amount') }}"><i class="ti-more"></i>Fee Category Amount</a></li>
            <li class="{{ ($route == 'view.exam.type') ? 'active' : '' }}"><a href="{{ route('view.exam.type') }}"><i class="ti-more"></i>View Exam Type</a></li>
            <li class="{{ ($route == 'view.school.subject') ? 'active' : '' }}"><a href="{{ route('view.school.subject') }}"><i class="ti-more"></i>View School Subject</a></li>
            <li class="{{ ($route == 'view.assign.subject') ? 'active' : '' }}"><a href="{{ route('view.assign.subject') }}"><i class="ti-more"></i>View Assign Subject</a></li>
            <li class="{{ ($route == 'view.designation') ? 'active' : '' }}"><a href="{{ route('view.designation') }}"><i class="ti-more"></i>View Designation</a></li>
          </ul>
        </li>

        <li class="treeview {{ ($prefix == '/students') ? 'active' : '' }}">
          <a href="#">
            <i data-feather="message-circle"></i>
            <span>Student Management</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{ ($route == 'view.student.reg') ? 'active' : '' }}"><a href="{{ route('view.student.reg') }}"><i class="ti-more"></i>View Student Registration</a></li>
            <li class="{{ ($route == 'view.roll.generate') ? 'active' : '' }}"><a href="{{ route('view.roll.generate') }}"><i class="ti-more"></i>View Roll Generate</a></li>
            <li class="{{ ($route == 'view.registration.fee') ? 'active' : '' }}"><a href="{{ route('view.registration.fee') }}"><i class="ti-more"></i>View Registration Fee</a></li>
            <li class="{{ ($route == 'view.monthly.fee') ? 'active' : '' }}"><a href="{{ route('view.monthly.fee') }}"><i class="ti-more"></i>View Montly Fee</a></li>
            <li class="{{ ($route == 'view.exam.fee') ? 'active' : '' }}"><a href="{{ route('view.exam.fee') }}"><i class="ti-more"></i>View Exam Fee</a></li>
          </ul>
        </li>

        <li class="treeview {{ ($prefix == '/employees') ? 'active' : '' }}">
          <a href="#">
            <i data-feather="message-circle"></i>
            <span>Employee Management</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{ ($route == 'view.employee.reg') ? 'active' : '' }}"><a href="{{ route('view.employee.reg') }}"><i class="ti-more"></i>View Employee Registration</a></li>
            <li class="{{ ($route == 'view.employee.salary') ? 'active' : '' }}"><a href="{{ route('view.employee.salary') }}"><i class="ti-more"></i>Employee Salary</a></li>
            <li class="{{ ($route == 'view.employee.leave') ? 'active' : '' }}"><a href="{{ route('view.employee.leave') }}"><i class="ti-more"></i>Employee Leave</a></li>
            <li class="{{ ($route == 'view.employee.attendance') ? 'active' : '' }}"><a href="{{ route('view.employee.attendance') }}"><i class="ti-more"></i>Employee Attendance</a></li>
            <li class="{{ ($route == 'view.monthly.salary') ? 'active' : '' }}"><a href="{{ route('view.monthly.salary') }}"><i class="ti-more"></i>Employee Monthly Salary</a></li>

          </ul>
        </li>

        <li class="treeview {{ ($prefix == '/marks') ? 'active' : '' }}">
          <a href="#">
            <i data-feather="message-circle"></i>
            <span>Marks Management</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{ ($route == 'add.entry.mark') ? 'active' : '' }}"><a href="{{ route('add.entry.mark') }}"><i class="ti-more"></i>Entry Marks</a></li>
            <li class="{{ ($route == 'edit.entry.mark') ? 'active' : '' }}"><a href="{{ route('edit.entry.mark') }}"><i class="ti-more"></i>Edit Marks</a></li>
            <li class="{{ ($route == 'view.grade.marks') ? 'active' : '' }}"><a href="{{ route('view.grade.marks') }}"><i class="ti-more"></i>Grade Marks</a></li>

          </ul>
        </li>

        <li class="treeview {{ ($prefix == '/accounts') ? 'active' : '' }}">
          <a href="#">
            <i data-feather="message-circle"></i>
            <span>Account Management</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{ ($route == 'student.fee.view') ? 'active' : '' }}"><a href="{{ route('student.fee.view') }}"><i class="ti-more"></i>Student Fee View</a></li>
            <li class="{{ ($route == 'employee.salary.view') ? 'active' : '' }}"><a href="{{ route('employee.salary.view') }}"><i class="ti-more"></i>Employee Salary View</a></li>
            <li class="{{ ($route == 'other.cost.view') ? 'active' : '' }}"><a href="{{ route('other.cost.view') }}"><i class="ti-more"></i>Other Cost View</a></li>

          </ul>
        </li>

        <li class="header nav-small-cap">Report Interface</li>

        <li class="treeview {{ ($prefix == '/reports') ? 'active' : '' }}">
            <a href="#">
              <i data-feather="message-circle"></i>
              <span>Reports Management</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-right pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li class="{{ ($route == 'monthly.profit.view') ? 'active' : '' }}"><a href="{{ route('monthly.profit.view') }}"><i class="ti-more"></i>Monthly-Yearly Profit</a></li>
              <li class="{{ ($route == 'marksheet.generate.view') ? 'active' : '' }}"><a href="{{ route('marksheet.generate.view') }}"><i class="ti-more"></i>MarkSheet Generate View</a></li>
              <li class="{{ ($route == 'attendance.report.view') ? 'active' : '' }}"><a href="{{ route('attendance.report.view') }}"><i class="ti-more"></i>Attendance Report</a></li>
              <li class="{{ ($route == 'student.result.view') ? 'active' : '' }}"><a href="{{ route('student.result.view') }}"><i class="ti-more"></i>Student Result</a></li>
              <li class="{{ ($route == 'student.idcard.view') ? 'active' : '' }}"><a href="{{ route('student.idcard.view') }}"><i class="ti-more"></i>Student ID Card</a></li>

            </ul>
        </li>

      </ul>
    </section>

</aside>
