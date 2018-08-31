@extends($master)

@section('page')
    {{ trans('ticketit::admin.role-index-title') }}
@stop

@section('content')
    @include('ticketit::shared.header')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h2>{{ trans('ticketit::admin.role-index-title') }}
                {!! link_to_route(
                                    $setting->grab('admin_route').'.role.create',
                                    trans('ticketit::admin.btn-create-new-role'), null,
                                    ['class' => 'btn btn-primary pull-right'])
                !!}
            </h2>
        </div>

        @if ($roles->isEmpty())
            <h3 class="text-center">{{ trans('ticketit::admin.role-index-no-roles') }}
                {!! link_to_route($setting->grab('admin_route').'.role.create', trans('ticketit::admin.role-index-create-new')) !!}
            </h3>
        @else
            <div id="message"></div>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <td>{{ trans('ticketit::admin.table-id') }}</td>
                        <td>{{ trans('ticketit::admin.table-name') }}</td>
                        <td>Công ty được phân quyền</td>
                        <td>Ds Công ty</td>
                        <td>Xóa</td>
                    </tr>
                </thead>
                <tbody>
                   @foreach($roles as $role)
                       <tr>
                           <td>
                               {{ $role->id }}
                           </td>
                           <td>
                               {{ $role->name }}
                           </td>
                           <td>
                               @foreach($role->companies as $company)
                                   <span>
                                       {{  $company->name }}
                                   </span>
                               @endforeach
                           </td>
                           <td>
                               {!! CollectiveForm::open([
                                               'method' => 'PATCH',
                                               'route' => [
                                                           $setting->grab('admin_route').'.role.update',
                                                           $role->id
                                                           ],
                                               ]) !!}
                               @foreach(App\Company::all() as $company_cat)                                
                                   <input name="company_cats[]"
                                          type="checkbox"
                                          value="{{ $company_cat->id }}"            
                                          {!! ($company_cat->users->where("id", $role->id)->count() > 0) ? "checked" : ""  !!}
                                          > {{$company_cat->name}}
                               @endforeach
                               {!! CollectiveForm::submit(trans('ticketit::admin.btn-join'), ['class' => 'btn btn-info btn-sm']) !!}
                               {!! CollectiveForm::close() !!}
                           </td>
                           <td>
                               {!! CollectiveForm::open([
                               'method' => 'DELETE',
                               'route' => [
                                           $setting->grab('admin_route').'.agent.destroy',
                                           $role->id
                                           ],
                               'id' => "delete-$role->id"
                               ]) !!}
                               {!! CollectiveForm::submit(trans('ticketit::admin.btn-remove'), ['class' => 'btn btn-danger']) !!}
                               {!! CollectiveForm::close() !!}
                           </td>
                       </tr>
                   @endforeach
                </tbody>
            </table>

        @endif
    </div>
@stop
