@extends($master)

@section('page')
    {{ trans('ticketit::admin.company-index-title') }}
@stop

@section('content')
    @include('ticketit::shared.header')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h2>{{ trans('ticketit::admin.company-index-title') }}
                {!! link_to_route(
                                    $setting->grab('admin_route').'.company.create',
                                    trans('ticketit::admin.btn-create-new-company'), null,
                                    ['class' => 'btn btn-primary pull-right'])
                !!}
            </h2>
        </div>

        @if ($companies->isEmpty())
            <h3 class="text-center">Không có công ty 
                {!! link_to_route($setting->grab('admin_route').'.company.create', trans('ticketit::admin.company-index-create-new')) !!}
            </h3>
        @else
            <div id="message"></div>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <td>Id</td>
                        <td>Mã</td>
                        <td>Tên</td>
                        <td>Tác vụ</td>
                    </tr>
                </thead>
                <tbody>
                @foreach($companies as $company)
                    <tr>
                        <td style="vertical-align: middle">
                            {{ $company->id }}
                        </td>
                        <td style="vertical-align: middle">
                            {{ $company->company_code }}
                        </td>
                        <td style="vertical-align: middle">
                            {{ $company->name}}
                        </td>
                        <td>
                            {!! link_to_route(
                                                    $setting->grab('admin_route').'.company.edit', trans('ticketit::admin.btn-edit'), $company->id,
                                                    ['class' => 'btn btn-info'] )
                                !!}

                                {!! link_to_route(
                                                    $setting->grab('admin_route').'.company.destroy', trans('ticketit::admin.btn-delete'), $company->id,
                                                    [
                                                    'class' => 'btn btn-danger deleteit',
                                                    'form' => "delete-$company->id",
                                                    "node" => $company->name
                                                    ])
                                !!}
                            {!! CollectiveForm::open([
                                            'method' => 'DELETE',
                                            'route' => [
                                                        $setting->grab('admin_route').'.company.destroy',
                                                        $company->id
                                                        ],
                                            'id' => "delete-$company->id"
                                            ])
                            !!}
                            {!! CollectiveForm::close() !!}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif
    </div>
@stop
@section('footer')
    <script>
        $( ".deleteit" ).click(function( event ) {
            event.preventDefault();
            if (confirm("{!! trans('ticketit::admin.company-index-js-delete') !!}" + $(this).attr("node") + " ?"))
            {
                $form = $(this).attr("form");
                $("#" + $form).submit();
            }

        });
    </script>
@append
