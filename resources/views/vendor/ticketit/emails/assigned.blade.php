<?php $notification_owner = unserialize($notification_owner);?>
<?php $ticket = unserialize($ticket);?>

@extends($email)

@section('subject')
	{{ trans('ticketit::email/globals.assigned') }}
@stop

@section('link')
	<a style="color:#ffffff" href="{{ route($setting->grab('main_route').'.show', $ticket->id) }}">
		{{ trans('ticketit::email/globals.view-ticket') }}
	</a>
@stop

@section('content')
	<?php $code = $ticket->category->code . $ticket->date_request->day . $ticket->date_request->month . $ticket->date_request->year . $ticket->id ?>
	{!! trans('ticketit::email/assigned.data', [
		'name'      =>  $notification_owner->name,
		'subject'   =>  $ticket->id,
		'status'    =>  $ticket->status->name,
		'category'  =>  $ticket->category->name,
		'code' 		=>  $code,
	]) !!}
@stop
