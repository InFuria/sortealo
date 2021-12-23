<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RaffleClient extends Model
{
    protected $table = "raffle_clients";

    protected $fillable = [
        'raffle_id', 'client_id', 'status', 'paid', 'orderable_date'
    ];

    public function raffle(){
        return $this->belongsTo(Raffle::class);
    }

    public function client(){
        return $this->belongsTo(Client::class);
    }
}
