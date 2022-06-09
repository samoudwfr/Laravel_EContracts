<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    use HasFactory;

    protected $fillable = [
        'reference',
        'document',
        'sender_id',
        'receiver_id',
        'lawyer_id',
        'statusLawyer_id',
        'statusReceiver_id',
        
    ];

    public function customers(){
        return $this->belongsToMany(Customer::class);
    }

    public function status(){
        return $this->hasOne(Status::class);
    }

}
