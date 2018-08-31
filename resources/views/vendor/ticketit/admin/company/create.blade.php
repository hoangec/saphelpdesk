@extends($master)
@section('page', trans('ticketit::admin.comapny-create-title'))

@section('content')
    @include('ticketit::shared.header')
    <div class="well bs-component">
        {!! CollectiveForm::open(['route'=> $setting->grab('admin_route').'.company.store', 'method' => 'POST', 'class' => 'form-horizontal']) !!}
            <legend>{{ trans('ticketit::admin.company-create-title') }}</legend>
            @include('ticketit::admin.company.form')
        {!! CollectiveForm::close() !!}
    </div>
@stop
