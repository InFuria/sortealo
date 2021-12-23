<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [
        'name', 'identification', 'email', 'phone', 'address', 'status'
    ];

    public function raffles(){
        return $this->belongsToMany(Raffle::class, 'raffle_clients', 'client_id', 'raffle_id');
    }
}
