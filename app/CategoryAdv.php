<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kordy\Ticketit\Models\Category;

class CategoryAdv extends Category
{
    //
    protected $fillable = ['name', 'color','code','parameters'];
    
}
