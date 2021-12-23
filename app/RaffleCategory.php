<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RaffleCategory extends Model
{
    protected $table = "raffle_categories";

    protected $fillable = [
        'name'
    ];

    public function raffles(){
        return $this->hasMany(Raffle::class, 'category_id', 'id');
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
