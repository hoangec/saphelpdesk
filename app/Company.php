<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    //
    protected $table = 'companies';

    protected $fillable = ['name', 'company_code'];
    public $timestamps = false;

    public function users()
    {
        return $this->belongsToMany('\App\User', 'ticketit_companies_users','company_id','user_id');
    }
    public function tickets()
    {
        return $this->hasMany('TicketAdv', 'company_id');
    }
}
