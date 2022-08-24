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
          </ul>
        </li>

        <li class="treeview">
          <a href="#">
            <i data-feather="mail"></i> <span>Mailbox</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="mailbox_inbox.html"><i class="ti-more"></i>Inbox</a></li>
            <li><a href="mailbox_compose.html"><i class="ti-more"></i>Compose</a></li>
            <li><a href="mailbox_read_mail.html"><i class="ti-more"></i>Read</a></li>
          </ul>
        </li>

        <li class="header nav-small-cap">User Interface</li>

        <li class="treeview">
          <a href="#">
            <i data-feather="grid"></i>
            <span>Components</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="components_alerts.html"><i class="ti-more"></i>Alerts</a></li>
          </ul>
        </li>

      </ul>
    </section>

	<div class="sidebar-footer">
		<!-- item-->
		<a href="javascript:void(0)" class="link" data-toggle="tooltip" title="" data-original-title="Settings" aria-describedby="tooltip92529"><i class="ti-settings"></i></a>
		<!-- item-->
		<a href="mailbox_inbox.html" class="link" data-toggle="tooltip" title="" data-original-title="Email"><i class="ti-email"></i></a>
		<!-- item-->
		<a href="javascript:void(0)" class="link" data-toggle="tooltip" title="" data-original-title="Logout"><i class="ti-lock"></i></a>
	</div>
</aside>
