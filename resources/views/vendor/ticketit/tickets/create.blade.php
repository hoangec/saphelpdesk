@extends($master)
@section('page', trans('ticketit::lang.create-ticket-title'))
@section('content')
@include('ticketit::shared.header')
    <div class="well bs-component">
        {!! Form::open([
                        'route'=>$setting->grab('main_route').'.store',
                        'method' => 'POST',
                        'class' => 'form-horizontal',
                        'name' => 'ticketForm'
                        ]) !!}
            <legend>{!! trans('ticketit::lang.create-new-ticket') . ' ' .$category->name!!}</legend>
            <div class="form-group">
                {!! CollectiveForm::label('company','Công ty', ['class' => 'col-lg-2 control-label']) !!}
                <div class="col-lg-10">
                    <select class="form-control" name="companies">
                        @foreach ($companies as $company)
                            <option value="{{ $company->id }}">{{ $company->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>   
            <div class="form-group">
                {!! CollectiveForm::label('dateRequest','Ngày yêu cầu', ['class' => 'col-lg-2 control-label']) !!}
                <div class="col-lg-10">
                    <div class="input-group date">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input name="date_request" type="text" class="form-control pull-right" id="datepicker">
                    </div>
                </div>                
            </div>
            <div class="form-group">
                {!! CollectiveForm::label('category', trans('ticketit::lang.category') . trans('ticketit::lang.colon'), ['class' => 'col-lg-2 control-label']) !!}
                <div class="col-lg-10">
                    {!! CollectiveForm::text('category', $category->name, ['class' => 'form-control', 'disabled' => 'true']) !!}
                    {!! CollectiveForm::hidden('category_id', $category->id, ['class' => 'form-control', 'required' => 'required']) !!}
                </div>
            </div>
            <div class="form-group">
                {!! CollectiveForm::label('subject', 'Ghi chú' . trans('ticketit::lang.colon'), ['class' => 'col-lg-2 control-label']) !!}
                <div class="col-lg-10">
                    {!! CollectiveForm::text('subject', null, ['class' => 'form-control']) !!}
                    <span class="help-block">Cung cấp thêm các thông tin cho yêu cầu khi anh chụp không được rõ !</span>
                </div>
            </div>
            <div class="form-group">
                {!! CollectiveForm::label('content', 'Hình ảnh' . trans('ticketit::lang.colon'), ['class' => 'col-lg-2 control-label']) !!}
                <div class="col-lg-10">
                    {!! CollectiveForm::textarea('content', null, ['class' => 'form-control summernote-editor', 'rows' => '5']) !!}
                    <span class="help-block">Cung cấp ảnh chụp (có thể copy và dán nội dung ảnh vào khu vực này) </span>
                </div>
            </div>
            <div class="form-inline row">
                <div class="form-group col-lg-4">
                    {!! CollectiveForm::label('priority', trans('ticketit::lang.priority') . trans('ticketit::lang.colon'), ['class' => 'col-lg-6 control-label']) !!}
                    <div class="col-lg-6">
                        {!! CollectiveForm::select('priority_id', $priorities, null, ['class' => 'form-control', 'required' => 'required']) !!}
                    </div>
                </div>
               <!--  <div class="form-group col-lg-4">
                    {!! CollectiveForm::label('category', trans('ticketit::lang.category') . trans('ticketit::lang.colon'), ['class' => 'col-lg-6 control-label']) !!}
                    <div class="col-lg-6">
                        {!! CollectiveForm::select('category_id', $categories, null, ['class' => 'form-control','required' => 'required']) !!}
                    </div>
                </div> -->
                {!! CollectiveForm::hidden('agent_id', 'auto') !!}
            </div>
            <br>
            <div class="form-group">
                <div class="col-lg-10 col-lg-offset-2">
                    {!! link_to_route($setting->grab('main_route').'.index', trans('ticketit::lang.btn-back'), null, ['class' => 'btn btn-default']) !!}
                    {!! CollectiveForm::submit(trans('ticketit::lang.btn-submit'), ['class' => 'btn btn-primary']) !!}
                </div>
            </div>
        {!! CollectiveForm::close() !!}
    </div>
@endsection

@section('footer')
    @include('ticketit::tickets.partials.summernote')
    <script>
        $('#datepicker').datepicker({            
            language: 'vi'
        });
        $('#datepicker').datepicker("setDate", new Date());       
    </script>
@append