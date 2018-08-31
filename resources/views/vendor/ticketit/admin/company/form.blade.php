<div class="form-group">
    {!! CollectiveForm::label('name', trans('ticketit::admin.company-create-name') . trans('ticketit::admin.colon'), ['class' => 'col-lg-2 control-label']) !!}
    <div class="col-lg-10">
        {!! CollectiveForm::text('name', isset($company->name) ? $company->name : null, ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! CollectiveForm::label('name', trans('ticketit::admin.company-create-code') . trans('ticketit::admin.colon'), ['class' => 'col-lg-2 control-label']) !!}
    <div class="col-lg-10">
        {!! CollectiveForm::text('company_code', isset($company->code) ? $company->company_code : null, ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    <div class="col-lg-10 col-lg-offset-2">
        {!! link_to_route($setting->grab('admin_route').'.company.index', trans('ticketit::admin.btn-back'), null, ['class' => 'btn btn-default']) !!}
        @if(isset($status))
            {!! CollectiveForm::submit(trans('ticketit::admin.btn-update'), ['class' => 'btn btn-primary']) !!}
        @else
            {!! CollectiveForm::submit(trans('ticketit::admin.btn-submit'), ['class' => 'btn btn-primary']) !!}
        @endif
    </div>
</div>
