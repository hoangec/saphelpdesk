<div class="form-group">
    {!! CollectiveForm::label('name', trans('ticketit::admin.category-create-name') . trans('ticketit::admin.colon'), ['class' => 'col-lg-2 control-label']) !!}
    <div class="col-lg-10">
        {!! CollectiveForm::text('name', isset($category->name) ? $category->name : null, ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! CollectiveForm::label('code','Mã danh mục: ', ['class' => 'col-lg-2 control-label']) !!}
    <div class="col-lg-10">
        {!! CollectiveForm::text('code', isset($category->code) ? $category->code : null, ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! CollectiveForm::label('parameters','Tham số: ', ['class' => 'col-lg-2 control-label']) !!}
    <div class="col-lg-10">
        {!! CollectiveForm::text('parameters', isset($category->parameters) ? $category->parameters : null, ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! CollectiveForm::label('color', trans('ticketit::admin.category-create-color') . trans('ticketit::admin.colon'), ['class' => 'col-lg-2 control-label']) !!}
    <div class="col-lg-10">
        {!! CollectiveForm::custom('color', 'color', isset($category->color) ? $category->color : "#000000", ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    <div class="col-lg-10 col-lg-offset-2">
        {!! link_to_route($setting->grab('admin_route').'.category.index', trans('ticketit::admin.btn-back'), null, ['class' => 'btn btn-default']) !!}
        @if(isset($category))
            {!! CollectiveForm::submit(trans('ticketit::admin.btn-update'), ['class' => 'btn btn-primary']) !!}
        @else
            {!! CollectiveForm::submit(trans('ticketit::admin.btn-submit'), ['class' => 'btn btn-primary']) !!}
        @endif
    </div>
</div>
