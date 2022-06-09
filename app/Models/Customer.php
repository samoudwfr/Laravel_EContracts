<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    // protected $guarded = [];
    protected $fillable = [
        'user_id',
        'civil_id',
        'role_id',
        'phone',
        'address',
        'gender',
        'age',
        'customer_number',
    ];

    public function role(){
        return $this->hasOne(Role::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function civil(){
        return $this->belongsTo(Civil::class);
    }

    public function contracts(){
        return $this->belongsToMany(Contract::class);
        // return $this->hasMany(Contract::class);
    }
}
