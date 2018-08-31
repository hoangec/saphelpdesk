@extends($master)
@section('page', trans('ticketit::admin.company-edit-title', ['name' => ucwords($company->name)]))

@section('content')
    @include('ticketit::shared.header')
    <div class="well bs-component">
        {!! CollectiveForm::model($company, [
                                    'route' => [$setting->grab('admin_route').'.company.update', $company->id],
                                    'method' => 'PATCH',
                                    'class' => 'form-horizontal'
                                    ]) !!}
        <legend>{{ trans('ticketit::admin.company-edit-title', ['name' => ucwords($company->name)]) }}</legend>
        @include('ticketit::admin.company.form', ['update', true])
        {!! CollectiveForm::close() !!}
    </div>
@stop
