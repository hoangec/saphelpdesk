<?php

return [

 /*
  *  Constants
  */

  'nav-active-tickets'               => 'Các yêu cầu chưa xử lý',
  'nav-completed-tickets'            => 'Các yêu cầu hoàn thành',

  // Tables
  'table-id'                         => '#',
  'table-subject'                    => 'Nội dung',
  'table-owner'                      => 'Nv yêu cầu',
  'table-status'                     => 'Trạng thái',
  'table-last-updated'               => 'Thay đổi gần nhất',
  'table-priority'                   => 'Độ ưu tiên',
  'table-agent'                      => 'Nv hỗ trợ',
  'table-category'                   => 'Danh mục',

  // Datatables
  'table-decimal'                    => '',
  'table-empty'                      => 'Không có dữ liệu',
  'table-info'                       => 'Hiển thị _START_ tới _END_ của _TOTAL_ dòng',
  'table-info-empty'                 => 'Hiển thị 0 tới 0 của 0 dòng',
  'table-info-filtered'              => '(Được lọc từ _MAX_ dòng )',
  'table-info-postfix'               => '',
  'table-thousands'                  => ',',
  'table-length-menu'                => 'Hiển thị _MENU_ dòng',
  'table-loading-results'            => 'Đang tải...',
  'table-processing'                 => 'Đang xử lý...',
  'table-search'                     => 'Tìm kiếm:',
  'table-zero-records'               => 'Không tìm thấy',
  'table-paginate-first'             => 'Đầu tiên',
  'table-paginate-last'              => 'Cuối cùng',
  'table-paginate-next'              => 'Tiếp theo',
  'table-paginate-prev'              => 'Quay lại',
  'table-aria-sort-asc'              => ': activate to sort column ascending',
  'table-aria-sort-desc'             => ': activate to sort column descending',

  'btn-back'                         => 'Quay lại',
  'btn-cancel'                       => 'Hủy', // NEW
  'btn-close'                        => 'Đóng',
  'btn-delete'                       => 'Xóa',
  'btn-edit'                         => 'Chỉnh sửa',
  'btn-mark-complete'                => 'Hoàn thành',
  'btn-submit'                       => 'Xác nhận',

  'agent'                            => 'Nv hỗ trợ',
  'category'                         => 'Danh mục',
  'colon'                            => ': ',
  'comments'                         => 'Bình luận',
  'created'                          => 'Được tạo',
  'description'                      => 'Mô tả',
  'flash-x'                          => '×', // &times;
  'last-update'                      => 'Thay đổi gần nhất',
  'no-replies'                       => 'Không phản hồi.',
  'owner'                            => 'Nv yêu cầu',
  'priority'                         => 'Độ ưu tiên',
  'reopen-ticket'                    => 'Mở lại yêu cầu',
  'reply'                            => 'Phản hồi',
  'responsible'                      => 'Nhân viên xử lý',
  'status'                           => 'Trạng thái',
  'subject'                          => 'Nội dung',

 /*
  *  Page specific
  */

// ____
  'index-title'                      => 'Helpdesk main page',

// tickets/____
  'index-my-tickets'                 => 'Ds các yêu cầu',
  'btn-create-new-ticket'            => 'Tạo mới',
  'index-complete-none'              => 'Không có yêu cầu trạng thái hoàn thành',
  'index-active-check'               => 'Be sure to check Active Tickets if you cannot find your ticket.',
  'index-active-none'                => 'Không có yêu cầu trạng thái chờ xử lý,',
  'index-create-new-ticket'          => 'Tảo mới yêu cầu',
  'index-complete-check'             => 'Be sure to check Complete Tickets if you cannot find your ticket.',

  'create-ticket-title'              => 'New Ticket Form',
  'create-new-ticket'                => 'Tạo mới yêu cầu',
  'create-ticket-brief-issue'        => 'Tiêu đề yêu cầu',
  'create-ticket-describe-issue'     => 'Mô tả chi tiết yêu cầu',

  'show-ticket-title'                => 'Yêu cầu',
  'show-ticket-js-delete'            => 'Bạn có chắc xóa yêu cầu này: ',
  'show-ticket-modal-delete-title'   => 'Xóa yêu cầu',
  'show-ticket-modal-delete-message' => 'Bạn có chắc xoáyêu Priorit ticket: :subject?',

 /*
  *  Controllers
  */

// AgentsController
  'agents-are-added-to-agents'                      => 'Agents :names are added to agents',
  'administrators-are-added-to-administrators'      => 'Administrators :names are added to administrators', //New
  'agents-joined-categories-ok'                     => 'Joined categories successfully',
  'agents-is-removed-from-team'                     => 'Removed agent\s :name from the agent team',
  'administrators-is-removed-from-team'             => 'Removed administrator\s :name from the administrators team', // New

// CategoriesController
  'category-name-has-been-created'   => 'Danh mục :name đã được tạo!',
  'category-name-has-been-modified'  => 'Danh mục :name đã thay đổi thành công!',
  'category-name-has-been-deleted'   => 'Danh mục :name đã xoa thành công!',
 
// PrioritiesController
  'priority-name-has-been-created'   => 'The priority :name has been created!',
  'priority-name-has-been-modified'  => 'The priority :name has been modified!',
  'priority-name-has-been-deleted'   => 'The priority :name has been deleted!',
  'priority-all-tickets-here'        => 'All priority related tickets here',

// StatusesController
  'status-name-has-been-created'   => 'The status :name has been created!',
  'status-name-has-been-modified'  => 'The status :name has been modified!',
  'status-name-has-been-deleted'   => 'The status :name has been deleted!',
  'status-all-tickets-here'        => 'All status related tickets here',

// CommentsController
  'comment-has-been-added-ok'        => 'Nhận xét của bạn đã được đưa lên hệ thống',

// NotificationsController
  'notify-new-comment-from'          => 'Bình luận mới từ',
  'notify-on'                        => ' trên yêu cầu',
  'notify-status-to-complete'        => ' trạng thái yêu cầu đã hoàn thành',
  'notify-status-to'                 => ' thành ',
  'notify-transferred'               => ' được chuyển tiến ',
  'notify-to-you'                    => ' tới bạn',
  'notify-created-ticket'            => ' đã tạo mới một yêu cầu số:  ',
  'notify-updated'                   => ' đã cập nhập trạng thái yêu cầu số:',

 // TicketsController
  'the-ticket-has-been-created'      => 'Yêu cầu đã được tạo!',
  'the-ticket-has-been-modified'     => 'Yêu cầu đã được thay đổi!',
  'the-ticket-has-been-deleted'      => 'Yêu cầu đã bị xóa!',
  'the-ticket-has-been-completed'    => 'Yêu cầu :name đã hoàn thành!',
  'the-ticket-has-been-reopened'     => 'Yêu cầu :name đã được mở lại!',
  'you-are-not-permitted-to-do-this' => 'Bạn không được quyền sử dụng chức năng này!',
  // COmpanyController
    'company-name-has-been-created'   => 'Công ty :name đã được tạo!',
    'company-name-has-been-modified'  => 'Công ty :name đã được thay đổi!',
    'company-name-has-been-deleted'   => 'Công ty :name đã được xóa!',
  // TicketRoleController
    'roles-are-added-to-roles'                      => 'Nhân viên :names đã được thêm vào danh sách phân quyền',
    'roles-joined-categories-ok'                     => 'Đã phân quyền nhân viên vào công ty thành công',
    'roles-is-removed-from-team'                     => 'Đã gỡ phân quyền :name ra khỏi danh sách',
 /*
 *  Middlewares
 */

 //  IsAdminMiddleware IsAgentMiddleware ResAccessMiddleware
  'you-are-not-permitted-to-access'     => 'You are not permitted to access this page!',

];
