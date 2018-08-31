<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Poster extends User
{
    //
    protected $table = 'users';
    
    public function companies()
    {
        return $this->belongsToMany('Company', 'ticketit_companies_users', 'user_id', 'company_id');
    }
}
