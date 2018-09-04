<?php
Route::group(['middleware' => \Kordy\Ticketit\Helpers\LaravelVersion::authMiddleware()], function () use ($main_route, $main_route_path, $admin_route, $admin_route_path) {

    //Route::group(['middleware' => '', function () use ($main_route) {
    //Ticket public route
    Route::get("$main_route_path/complete", 'App\Http\Controllers\SomeController@indexComplete')
            ->name("$main_route-complete");

    Route::get("$main_route_path/error", 'App\Http\Controllers\SomeController@indexError')
            ->name("$main_route-error");
    Route::get("$main_route_path/data/{id?}", 'App\Http\Controllers\SomeController@data')
            ->name("$main_route.data");

    $field_name = last(explode('/', $main_route_path));
    Route::resource($main_route_path, 'App\Http\Controllers\SomeController', [
            'names' => [
                'index'   => $main_route.'.index',
                'store'   => $main_route.'.store',
                //'create'  => $main_route.'.create',
                'update'  => $main_route.'.update',
                'show'    => $main_route.'.show',
                'destroy' => $main_route.'.destroy',
                'edit'    => $main_route.'.edit',
            ],
            'parameters' => [
                $field_name => 'ticket',
            ],
            'except' => 'create',
        ]);
    Route::get("$main_route_path/create/{type?}", 'App\Http\Controllers\SomeController@createCus')
            ->name("$main_route.create");
    //Ticket Comments public route
    $field_name = last(explode('/', "$main_route_path-comment"));
    Route::resource("$main_route_path-comment", 'Kordy\Ticketit\Controllers\CommentsController', [
            'names' => [
                'index'   => "$main_route-comment.index",
                'store'   => "$main_route-comment.store",
               /* 'create'  => "$main_route-comment.create",*/
                'update'  => "$main_route-comment.update",
                'show'    => "$main_route-comment.show",
                'destroy' => "$main_route-comment.destroy",
                'edit'    => "$main_route-comment.edit",
            ],
            'parameters' => [
                $field_name => 'ticket_comment',
            ],
        ]);

    //Ticket complete route for permitted user.
    Route::get("$main_route_path/{id}/complete", 'App\Http\Controllers\SomeController@complete')
            ->name("$main_route.complete");
    // Ticket make error
    Route::get("$main_route_path/{id}/error", 'App\Http\Controllers\SomeController@makeError')
            ->name("$main_route.error");
    //Ticket reopen route for permitted user.
    Route::get("$main_route_path/{id}/reopen", 'App\Http\Controllers\SomeController@reopen')
            ->name("$main_route.reopen");
    //});

    Route::group(['middleware' => 'Kordy\Ticketit\Middleware\IsAgentMiddleware'], function () use ($main_route, $main_route_path) {

        //API return list of agents in particular category
        Route::get("$main_route_path/agents/list/{category_id?}/{ticket_id?}", [
            'as'   => $main_route.'agentselectlist',
            'uses' => 'App\Http\Controllers\SomeController@agentSelectList',
        ]);
    });

    Route::get("$admin_route_path/indicator/{indicator_period?}", [
            'as'   => $admin_route.'.dashboard.indicator',
            'uses' => '\App\Http\Controllers\DashboardCusController@indexNew',
    ]);
    Route::get($admin_route_path, '\App\Http\Controllers\DashboardCusController@indexNew');
    Route::get("$admin_route_path/report_company", '\App\Http\Controllers\DashboardCusController@getGeneralReportByCompanyAndDate');
    Route::get("$admin_route_path/report_categories", '\App\Http\Controllers\DashboardCusController@getGeneralReportByCategories');

    Route::group(['middleware' => 'Kordy\Ticketit\Middleware\IsAdminMiddleware'], function () use ($admin_route, $admin_route_path) {
        //Ticket admin index route (ex. http://url/tickets-admin/)


        //Ticket statuses admin routes (ex. http://url/tickets-admin/status)
        Route::resource("$admin_route_path/status", 'Kordy\Ticketit\Controllers\StatusesController', [
            'names' => [
                'index'   => "$admin_route.status.index",
                'store'   => "$admin_route.status.store",
                'create'  => "$admin_route.status.create",
                'update'  => "$admin_route.status.update",
                'show'    => "$admin_route.status.show",
                'destroy' => "$admin_route.status.destroy",
                'edit'    => "$admin_route.status.edit",
            ],
        ]);

        //Ticket priorities admin routes (ex. http://url/tickets-admin/priority)
        Route::resource("$admin_route_path/priority", 'Kordy\Ticketit\Controllers\PrioritiesController', [
            'names' => [
                'index'   => "$admin_route.priority.index",
                'store'   => "$admin_route.priority.store",
                'create'  => "$admin_route.priority.create",
                'update'  => "$admin_route.priority.update",
                'show'    => "$admin_route.priority.show",
                'destroy' => "$admin_route.priority.destroy",
                'edit'    => "$admin_route.priority.edit",
            ],
        ]);

        //Agents management routes (ex. http://url/tickets-admin/agent)
        Route::resource("$admin_route_path/agent", 'Kordy\Ticketit\Controllers\AgentsController', [
            'names' => [
                'index'   => "$admin_route.agent.index",
                'store'   => "$admin_route.agent.store",
                'create'  => "$admin_route.agent.create",
                'update'  => "$admin_route.agent.update",
                'show'    => "$admin_route.agent.show",
                'destroy' => "$admin_route.agent.destroy",
                'edit'    => "$admin_route.agent.edit",
            ],
        ]);

        //Catelogies management routes (ex. http://url/tickets-admin/catelogies)
        Route::resource("$admin_route_path/category", '\App\Http\Controllers\CategoriesCusController', [
            'names' => [
                'index'   => "$admin_route.category.index",
                'store'   => "$admin_route.category.store",
                'create'  => "$admin_route.category.create",
                'update'  => "$admin_route.category.update",
                'show'    => "$admin_route.category.show",
                'destroy' => "$admin_route.category.destroy",
                'edit'    => "$admin_route.category.edit",
            ],
        ]);
        //Company management routes (ex. http://url/tickets-admin/companies)
        Route::resource("$admin_route_path/company", '\App\Http\Controllers\CompanyController', [
            'names' => [
                'index'   => "$admin_route.company.index",
                'store'   => "$admin_route.company.store",
                'create'  => "$admin_route.company.create",
                'update'  => "$admin_route.company.update",
                'show'    => "$admin_route.company.show",
                'destroy' => "$admin_route.company.destroy",
                'edit'    => "$admin_route.company.edit",
            ],
        ]);
        //Ticket role management routes (ex. http://url/tickets-admin/roles)
        Route::resource("$admin_route_path/role", '\App\Http\Controllers\TicketRoleController', [
            'names' => [
                'index'   => "$admin_route.role.index",
                'store'   => "$admin_route.role.store",
                'create'  => "$admin_route.role.create",
                'update'  => "$admin_route.role.update",
                'show'    => "$admin_route.role.show",
                'destroy' => "$admin_route.role.destroy",
                'edit'    => "$admin_route.role.edit",
            ],
        ]);
        //Settings configuration routes (ex. http://url/tickets-admin/configuration)
        Route::resource("$admin_route_path/configuration", 'Kordy\Ticketit\Controllers\ConfigurationsController', [
            'names' => [
                'index'   => "$admin_route.configuration.index",
                'store'   => "$admin_route.configuration.store",
                'create'  => "$admin_route.configuration.create",
                'update'  => "$admin_route.configuration.update",
                'show'    => "$admin_route.configuration.show",
                'destroy' => "$admin_route.configuration.destroy",
                'edit'    => "$admin_route.configuration.edit",
            ],
        ]);

        //Administrators configuration routes (ex. http://url/tickets-admin/administrators)
        Route::resource("$admin_route_path/administrator", 'Kordy\Ticketit\Controllers\AdministratorsController', [
            'names' => [
                'index'   => "$admin_route.administrator.index",
                'store'   => "$admin_route.administrator.store",
                'create'  => "$admin_route.administrator.create",
                'update'  => "$admin_route.administrator.update",
                'show'    => "$admin_route.administrator.show",
                'destroy' => "$admin_route.administrator.destroy",
                'edit'    => "$admin_route.administrator.edit",
            ],
        ]);

        //Tickets demo data route (ex. http://url/tickets-admin/demo-seeds/)
        // Route::get("$admin_route/demo-seeds", 'Kordy\Ticketit\Controllers\InstallController@demoDataSeeder');
    });
});
