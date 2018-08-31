<div class="modal fade" id="ticket-edit-modal" tabindex="-1" role="dialog" aria-labelledby="ticket-edit-modal-Label">
    <div class="modal-dialog model-lg" role="document">
        <div class="modal-content">
            {!! CollectiveForm::model($ticket, [
            'route' => [$setting->grab('main_route').'.update', $ticket->id],
            'method' => 'PATCH',
            'class' => 'form-horizontal'
            ]) !!}
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">{{ trans('ticketit::lang.flash-x') }}</span></button>
                <h4 class="modal-title" id="ticket-edit-modal-Label">{{ $ticket->code }}</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    {!! CollectiveForm::label('status_id', trans('ticketit::lang.status') . trans('ticketit::lang.colon'), [
                    'class' => 'col-sm-3 control-label', 'for' => 'status_id'
                    ]) !!}
                   <!-- <label for="status_id" class="control-label col-sm-3">Trạng thái</label> -->
                   <div class="col-sm-9">
                       {!! CollectiveForm::select('status_id', $status_lists, $ticket->status_id, ['class' => 'form-control']) !!}
                   </div>
                </div>
                <div class="form-group">
                    {!! CollectiveForm::label('agent_id', trans('ticketit::lang.agent') . trans('ticketit::lang.colon'), [
                    'class' => 'col-sm-3 control-label'
                    ]) !!}
                   <div class="col-sm-9">
                       {!! CollectiveForm::select(
                       'agent_id',
                       $agent_lists,
                       $ticket->agent_id,
                       ['class' => 'form-control']) !!}
                   </div>
                </div>

<!-- <div class="col-md-12">
    <div class="form-group col-lg-6">
        {!! CollectiveForm::label('priority_id', trans('ticketit::lang.priority') . trans('ticketit::lang.colon'), ['class' => 'col-lg-4 control-label']) !!}
        <div class="col-lg-8">
            {!! CollectiveForm::select('priority_id', $priority_lists, $ticket->priority_id, ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="form-group col-lg-6">
        {!! CollectiveForm::label('agent_id', trans('ticketit::lang.agent') . trans('ticketit::lang.colon'), [
        'class' => 'col-lg-4 control-label'
        ]) !!}
        <div class="col-lg-8">
            {!! CollectiveForm::select(
            'agent_id',
            $agent_lists,
            $ticket->agent_id,
            ['class' => 'form-control']) !!}
        </div>
    </div>
</div> -->
            </div>
            
            <div class="clearfix"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('ticketit::lang.btn-close') }}</button>
                {!! CollectiveForm::submit(trans('ticketit::lang.btn-submit'), ['class' => 'btn btn-primary']) !!}
            </div>
            {!! CollectiveForm::close() !!}
        </div>
    </div>
</div>