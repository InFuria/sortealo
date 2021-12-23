<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RaffleType extends Model
{
    protected $table = "raffle_types";

    protected $fillable = [
        'name'
    ];

    public function raffles(){
        return $this->hasMany(Raffle::class, 'type_id', 'id');
    }

    public function getCreatedAtAttribute($value)
    {
        $date = date('Y-m-d H:i:s', strtotime($value));
        return $date;
    }

    public function getUpdatedAtAttribute($value)
    {
        $date = date('Y-m-d H:i:s', strtotime($value));
        return $date;
    }
}
