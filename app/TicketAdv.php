<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Kordy\Ticketit\Models\Setting;
use Kordy\Ticketit\Models\Status;
use Kordy\Ticketit\Models\Ticket;

class TicketAdv extends Ticket
{
    //
    public function company()
    {
      return $this->belongsTo('Company', 'company_id');
    }
    public function scopeError($query)
    {
  		$errorId = Setting::grab('default_error_status_id');
  		$status = Status::findOrFail($errorId);
  		return $query->whereNotNull('completed_at')->where('status_id',$status->id);
	  }
    public function scopeComplete($query)
    {
        $compateId = Setting::grab('default_close_status_id');
        return $query->whereNotNull('completed_at')
                     ->where('status_id',$compateId);
    }
}
