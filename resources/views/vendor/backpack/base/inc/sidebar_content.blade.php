<!-- This file is used to store sidebar items, starting with Backpack\Base 0.9.0 -->
<li><a href="{{ backpack_url('dashboard') }}"><i class="fa fa-dashboard"></i> <span>{{ trans('backpack::base.dashboard') }}</span></a></li>
<!-- <li><a href="{{ backpack_url('elfinder') }}"><i class="fa fa-files-o"></i> <span>{{ trans('backpack::crud.file_manager') }}</span></a></li> -->

<!--Ticket mgt -->
<li><a href="{{ backpack_url('tickets') }}"><i class="fa fa-files-o"></i> <span>Lưu chuyển chứng từ</span></a></li>
<!-- Users, Roles Permissions -->
@role('Admin')
<li class="treeview">
<a href="#"><i class="fa fa-group"></i> <span>Quản lý người dùng</span> <i class="fa fa-angle-left pull-right"></i></a>
<ul class="treeview-menu">
  <li><a href="{{ backpack_url('user') }}"><i class="fa fa-user"></i> <span>Người dùng</span></a></li>
  <li><a href="{{ backpack_url('role') }}"><i class="fa fa-group"></i> <span>Vai trò</span></a></li>
  <li><a href="{{ backpack_url('permission') }}"><i class="fa fa-key"></i> <span>Quyền</span></a></li>
</ul>
</li>
@endrole
