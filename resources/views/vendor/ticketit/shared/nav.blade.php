<div class="panel panel-default">
    <div class="panel-body">
        <ul class="nav nav-pills">
            <li role="presentation" class="{!! $tools->fullUrlIs(action('\App\Http\Controllers\SomeController@index')) ? "active" : "" !!}">
                <a href="{{ action('\App\Http\Controllers\SomeController@index') }}">{{ trans('ticketit::lang.nav-active-tickets') }}
                    <span class="badge">
                         <?php 
                            if ($u->isAdmin()) {
                                echo Kordy\Ticketit\Models\Ticket::active()->count();
                            } elseif ($u->isAgent()) {
                                echo Kordy\Ticketit\Models\Ticket::active()->agentUserTickets($u->id)->count();
                            } else {
                                echo Kordy\Ticketit\Models\Ticket::userTickets($u->id)->active()->count();
                            }
                        ?>
                    </span>
                </a>
            </li>
            <li role="presentation" class="{!! $tools->fullUrlIs(action('SomeController@indexComplete')) ? "active" : "" !!}">
                <a href="{{ action('SomeController@indexComplete') }}">{{ trans('ticketit::lang.nav-completed-tickets') }}
                    <span class="badge">
                        <?php 
                            if ($u->isAdmin()) {
                                echo app\TicketAdv::complete()->count();
                            } elseif ($u->isAgent()) {
                                echo app\TicketAdv::complete()->agentUserTickets($u->id)->count();
                            } else {
                                echo app\TicketAdv::userTickets($u->id)->complete()->count();
                            }
                        ?>
                    </span>
                </a>
            </li>
            @if($u->isAdmin())
                <li role="presentation" class="{!! $tools->fullUrlIs(action('SomeController@indexError')) ? "active" : "" !!}">
                    <a href="{{ action('SomeController@indexError') }}">Các Y/c lỗi
                        <span class="badge">
                            <?php
                                echo app\TicketAdv::error()->count();
                            ?>
                        </span>
                    </a>
                </li>
            @endif
            <li role="presentation" class="{!! $tools->fullUrlIs(action('\App\Http\Controllers\DashboardCusController@indexNew')) || Request::is($setting->grab('admin_route').'/indicator*') ? "active" : "" !!}">
                <a href="{{ action('\App\Http\Controllers\DashboardCusController@indexNew') }}">{{ trans('ticketit::admin.nav-dashboard') }}</a>
            </li>
            @if($u->isAdmin())                
                <li role="presentation" class="dropdown {!!
                    $tools->fullUrlIs(action('\Kordy\Ticketit\Controllers\StatusesController@index').'*') ||
                    $tools->fullUrlIs(action('\Kordy\Ticketit\Controllers\PrioritiesController@index').'*') ||
                    $tools->fullUrlIs(action('\Kordy\Ticketit\Controllers\AgentsController@index').'*') ||
                    $tools->fullUrlIs(action('CompanyController@index').'*') ||
                    $tools->fullUrlIs(action('TicketRoleController@index').'*') ||
                    $tools->fullUrlIs(action('CategoriesCusController@index').'*') ||
                    $tools->fullUrlIs(action('\Kordy\Ticketit\Controllers\ConfigurationsController@index').'*') ||
                    $tools->fullUrlIs(action('\Kordy\Ticketit\Controllers\AdministratorsController@index').'*')
                    ? "active" : "" !!}">

                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                        {{ trans('ticketit::admin.nav-settings') }} <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li role="presentation" class="{!! $tools->fullUrlIs(action('\Kordy\Ticketit\Controllers\StatusesController@index').'*') ? "active" : "" !!}">
                            <a href="{{ action('\Kordy\Ticketit\Controllers\StatusesController@index') }}">{{ trans('ticketit::admin.nav-statuses') }}</a>
                        </li>
                        <li role="presentation"  class="{!! $tools->fullUrlIs(action('\Kordy\Ticketit\Controllers\PrioritiesController@index').'*') ? "active" : "" !!}">
                            <a href="{{ action('\Kordy\Ticketit\Controllers\PrioritiesController@index') }}">{{ trans('ticketit::admin.nav-priorities') }}</a>
                        </li>
                        <li role="presentation"  class="{!! $tools->fullUrlIs(action('\Kordy\Ticketit\Controllers\AgentsController@index').'*') ? "active" : "" !!}">
                            <a href="{{ action('\Kordy\Ticketit\Controllers\AgentsController@index') }}">{{ trans('ticketit::admin.nav-agents') }}</a>
                        </li>
                        <li role="presentation"  class="{!! $tools->fullUrlIs(action('CompanyController@index').'*') ? "active" : "" !!}">
                            <a href="{{ action('CompanyController@index') }}">Công ty</a>
                        </li>
                        <li role="presentation"  class="{!! $tools->fullUrlIs(action('TicketRoleController@index').'*') ? "active" : "" !!}">
                            <a href="{{ action('TicketRoleController@index') }}">Phân quyền</a>
                        </li>
                        <li role="presentation"  class="{!! $tools->fullUrlIs(action('CategoriesCusController@index').'*') ? "active" : "" !!}">
                            <a href="{{ action('CategoriesCusController@index') }}">{{ trans('ticketit::admin.nav-categories') }}</a>
                        </li>
                        <li role="presentation"  class="{!! $tools->fullUrlIs(action('\Kordy\Ticketit\Controllers\ConfigurationsController@index').'*') ? "active" : "" !!}">
                            <a href="{{ action('\Kordy\Ticketit\Controllers\ConfigurationsController@index') }}">{{ trans('ticketit::admin.nav-configuration') }}</a>
                        </li>
                        <li role="presentation"  class="{!! $tools->fullUrlIs(action('\Kordy\Ticketit\Controllers\AdministratorsController@index').'*') ? "active" : "" !!}">
                            <a href="{{ action('\Kordy\Ticketit\Controllers\AdministratorsController@index')}}">{{ trans('ticketit::admin.nav-administrator') }}</a>
                        </li>
                    </ul>
                </li>
            @endif
        </ul>
    </div>
</div>
