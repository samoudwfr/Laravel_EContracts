<?php

namespace App\Models;

use Laratrust\Models\LaratrustRole;

class Role extends LaratrustRole
{
    public $guarded = [];

    public function customers(){
        return $this->belongsToMany(Customer::class);
    }
}
