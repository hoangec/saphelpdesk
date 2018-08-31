<?php

namespace App;

use App\Company;
use Backpack\CRUD\CrudTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
class User extends Authenticatable
{
    use CrudTrait; // <----- this
    use HasRoles; // <------ and this

    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function scopeHasRoles($query)
      {
          return $query->where('ticketit_role', '1');
      }

    public function companies()
    {
        return $this->belongsToMany('App\Company', 'ticketit_companies_users', 'user_id', 'company_id');

    }
}
