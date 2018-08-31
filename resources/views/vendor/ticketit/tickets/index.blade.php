<div class="panel panel-default">

    <div class="panel-heading">
        <!-- <h2>{{ trans('ticketit::lang.index-my-tickets') }}
            {!! link_to_route($setting->grab('main_route').'.create', trans('ticketit::lang.btn-create-new-ticket'), null, ['class' => 'btn btn-primary pull-right']) !!}
        </h2> -->
    	<div class="btn-group">
          <button type="button" class="btn btn-info">Tạo yêu cầu</button>
          <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
            <span class="caret"></span>
            <span class="sr-only">Toggle Dropdown</span>
          </button>
          <ul class="dropdown-menu" role="menu">
            @foreach ($categories as $category)
                <li><a href="{{route($setting->grab('main_route').'.create',['type' => $category->id])}}">{{ $category->name }}</a></li>  
            @endforeach
                    
<!--             <li class="divider"></li>
            <li><a href="#">Yêu cầu chi</a></li> -->
          </ul>
        </div>
    </div>

    <div class="panel-body">
        <div id="message"></div>

        @include('ticketit::tickets.partials.datatable')
    </div>

</div>
