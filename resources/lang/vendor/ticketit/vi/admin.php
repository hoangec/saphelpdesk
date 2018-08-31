<?php

return [

 /*
  *  Constants
  */
  'nav-settings'                  => 'Hệ thống',
  'nav-agents'                    => 'Nv hỗ trợ',
  'nav-dashboard'                 => 'Báo cáo',
  'nav-categories'                => 'Danh mục',
  'nav-priorities'                => 'Độ ưu tiên',
  'nav-statuses'                  => 'Trạng thái',
  'nav-configuration'             => 'Cấu hình',
  'nav-administrator'             => 'Quản trị viên',  //new

  'table-hash'                    => '#',
  'table-id'                      => 'ID',
  'table-name'                    => 'Tên',
  'table-action'                  => 'Tác vụ',
  'table-categories'              => 'Danh mục',
  'table-join-category'           => 'Danh muc hỗ trợ',
  'table-remove-agent'            => 'Xóa nv khỏi nhóm danh mục',
  'table-remove-administrator'    => 'Xóa nv khỏi nhóm quản trị', // New

  'table-slug'                    => 'Slug',
  'table-default'                 => 'Default Value',
  'table-value'                   => 'My Value',
  'table-lang'                    => 'Lang',
  'table-edit'                    => 'Edit',

  'btn-back'                      => 'Quay lại',
  'btn-delete'                    => 'Xóa',
  'btn-edit'                      => 'Sửa',
  'btn-join'                      => 'Tham gia',
  'btn-remove'                    => 'Xóa',
  'btn-submit'                    => 'Xác nhận',
  'btn-save'                      => 'Lưu',
  'btn-update'                    => 'Cập nhập',

  'colon'                         => ': ',

 /*
  *  Page specific
  */

// tickets-admin/____
  'index-title'                         => 'Tickets System Dashboard',
  'index-empty-records'                 => 'No tickets yet',
  'index-total-tickets'                 => 'Tổng số yêu cầu',
  'index-open-tickets'                  => 'Số yêu cầu chưa xử lý',
  'index-closed-tickets'                => 'Số yêu cầu hoàn thành',
  'index-performance-indicator'         => 'Performance Indicator',
  'index-periods'                       => 'Periods',
  'index-3-months'                      => '3 months',
  'index-6-months'                      => '6 months',
  'index-12-months'                     => '12 months',
  'index-tickets-share-per-category'    => 'Tickets share per category',
  'index-tickets-share-per-agent'       => 'Tickets share per agent',
  'index-categories'                    => 'Categories',
  'index-category'                      => 'Category',
  'index-agents'                        => 'Agents',
  'index-agent'                         => 'Agent',
  'index-administrators'                => 'Administrators',  //new
  'index-administrator'                 => 'Administrator',  //new
  'index-users'                         => 'Users',
  'index-user'                          => 'User',
  'index-tickets'                       => 'Tickets',
  'index-open'                          => 'Open',
  'index-closed'                        => 'Closed',
  'index-total'                         => 'Total',
  'index-month'                         => 'Month',
  'index-performance-chart'             => 'How many days in average to resolve a ticket?',
  'index-categories-chart'              => 'Tickets distribution per category',
  'index-agents-chart'                  => 'Tickets distribution per Agent',

// tickets-admin/agent/____
  'agent-index-title'             => 'Agent Management',
  'btn-create-new-agent'          => 'Create new agent',
  'agent-index-no-agents'         => 'There are no agents, ',
  'agent-index-create-new'        => 'Add agents',
  'agent-create-title'            => 'Add Agent',
  'agent-create-add-agents'       => 'Add Agents',
  'agent-create-no-users'         => 'There are no user accounts, create user accounts first.',
  'agent-create-select-user'      => 'Select user accounts to be added as agents',

// tickets-admin/administrators/____
  'administrator-index-title'                   => 'Administrator Management',  //new
  'btn-create-new-administrator'                => 'Create new administrator',  //new
  'administrator-index-no-administrators'       => 'There are no administrators, ',  //new
  'administrator-index-create-new'              => 'Add administrators',  //new
  'administrator-create-title'                  => 'Add Administrator',  //new
  'administrator-create-add-administrators'     => 'Add Administrators',  //new
  'administrator-create-no-users'               => 'There are no user accounts, create user accounts first.',  //new
  'administrator-create-select-user'            => 'Select user accounts to be added as administrators',  //new

// tickets-admin/category/____
  'category-index-title'          => 'Categories Management',
  'btn-create-new-category'       => 'Create new category',
  'category-index-no-categories'  => 'There are no categories, ',
  'category-index-create-new'     => 'create new category',
  'category-index-js-delete'      => 'Are you sure you want to delete the category: ',
  'category-create-title'         => 'Create New Category',
  'category-create-name'          => 'Name',
  'category-create-color'         => 'Color',
  'category-edit-title'           => 'Edit Category: :name',

// tickets-admin/priority/____
  'priority-index-title'          => 'Priorities Management',
  'btn-create-new-priority'       => 'Create new priority',
  'priority-index-no-priorities'  => 'There are no priorities, ',
  'priority-index-create-new'     => 'create new priority',
  'priority-index-js-delete'      => 'Are you sure you want to delete the priority: ',
  'priority-create-title'         => 'Create New Priority',
  'priority-create-name'          => 'Name',
  'priority-create-color'         => 'Color',
  'priority-edit-title'           => 'Edit Priority: :name',

// tickets-admin/status/____
  'status-index-title'            => 'Statuses Management',
  'btn-create-new-status'         => 'Create new status',
  'status-index-no-statuses'      => 'There are no statues,',
  'status-index-create-new'       => 'create new status',
  'status-index-js-delete'        => 'Are you sure you want to delete the status: ',
  'status-create-title'           => 'Create New Status',
  'status-create-name'            => 'Name',
  'status-create-color'           => 'Color',
  'status-edit-title'             => 'Edit Status: :name',
  // tickets-admin/company/____
    'company-index-title'            => 'Quản lý công ty',
    'btn-create-new-company'         => 'Tạo mới công ty',
    'company-index-no-companies'      => 'Không có công ty nào,',
    'company-index-create-new'       => 'Tạo mới công ty',
    'company-index-js-delete'        => 'Bạn có chắc xóa công ty này: ',
    'company-create-title'           => 'Tạo mới công ty',
    'company-create-name'            => 'Tên công ty',
    'company-create-code'      => 'Mã công ty',    
    'company-edit-title'             => 'Chỉnh sửa: :name',
// tickets-admin/roles/____
    'role-index-title'             => 'Quản lý phân quyền',
    'btn-create-new-role'          => 'Tạo mới phân quyền',
    'role-index-no-roles'         => 'Chưa có phân quyền, ',
    'role-index-create-new'        => 'Thêm phân quyền',
    'role-create-title'            => 'Chọn người dụng phân quyền',
    'role-create-add-agents'       => 'Add Agents',
    'role-create-no-users'         => 'Chưa có người dùng để phân quyên',
    'role-create-select-user'      => 'Chọn người dùng đưa vào ds phân quyền',    
// tickets-admin/configuration/____
  'config-index-title'            => 'Configuration Settings',
  'config-index-subtitle'         => 'Settings',
  'btn-create-new-config'         => 'Add new setting',
  'config-index-no-settings'      => 'There are no settings,',
  'config-index-initial'          => 'Initial',
  'config-index-tickets'          => 'Tickets',
  'config-index-notifications'    => 'Notifications',
  'config-index-permissions'      => 'Permissions',
  'config-index-editor'           => 'Editor', //Added: 2016.01.14
  'config-index-other'            => 'Other',
  'config-create-title'           => 'Create: New Global Setting',
  'config-create-subtitle'        => 'Create Setting',
  'config-edit-title'             => 'Edit: Global Configuration',
  'config-edit-subtitle'          => 'Edit Setting',
  'config-edit-id'                => 'ID',
  'config-edit-slug'              => 'Slug',
  'config-edit-default'           => 'Default value',
  'config-edit-value'             => 'My value',
  'config-edit-language'          => 'Language',
  'config-edit-unserialize'       => 'Get the array values, and change the values',
  'config-edit-serialize'         => 'Get the serialized string of the changed values (to be entered in the field)',
  'config-edit-should-serialize'  => 'Serialize', //Added: 2016-01-16
  'config-edit-eval-warning'      => 'When checked, the server will run eval()!
  									  Don\'t use this if eval() is disabled on your server or if you don\'t exactly know what you are doing!
  									  Exact code executed:', //Added: 2016-01-16
  'config-edit-reenter-password'  => 'Re-enter your password', //Added: 2016-01-16
  'config-edit-auth-failed'       => 'Password mismatch', //Added: 2016-01-16
  'config-edit-eval-error'        => 'Invalid value', //Added: 2016-01-16
  'config-edit-tools'             => 'Tools:',

];
