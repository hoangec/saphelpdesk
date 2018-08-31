@extends('backpack::layout')

@section('header')
    <section class="content-header">
      <h1>
        {{ trans('backpack::base.dashboard') }}<small>{{ trans('backpack::base.first_page_you_see') }}</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ backpack_url() }}">{{ config('backpack.base.project_name') }}</a></li>
        <li class="active">{{ trans('backpack::base.dashboard') }}</li>
      </ol>
    </section>
@endsection


@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <div class="box-title">Bản tin</div>
                </div>
                <div class="box-body">
                  <h3 style="font-style: italic;">Chào mừng</h3><dd><strong>{{ backpack_auth()->user()->name }} </strong>đến với ứng dụng hỗ trợ SAP phiên bản 0.1.</dd>
                  <h3 style="font-style: italic;">Sử dụng</h3>
                  <ul>
                    <li>Để gửi các yêu cầu tạo chứng từ xin vui lòng chọn chức năng: <a href="{{route('tickets.index')}}">lưu chuyển chứng từ</a></li>
                    <li>Tài liệu: <a href="#">Hướng dẫn sử dụng</a></li>
                  </ul>             
                  <h3 style="font-style: italic;">Hỗ trợ</h3>
                  <ul>
                    <li>Nhân viên hỗ trợ: Võ Trọng Hoàng</li>
                    <li>Email: hoang.vo@hagl.com.vn</li>
                    <li>SĐT: (84)909280022</li>
                    <li>Zalo: Hoang Vo</li>                    
                  </ul>
                  <p>Vì ứng dụng đang trong quá trình hoàn thiện, nên có nhiều thiếu xót. Mọi phản hồi trong quá trình sử dụng xin liên hệ với SAP Team để được hỗ trợ.</p>
                </div>
            </div>
        </div>
    </div>
@endsection
