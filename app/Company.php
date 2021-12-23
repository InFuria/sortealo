<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Company extends Model
{
    protected $fillable = [
        'name', 'email', 'phone', 'address', 'webpage', 'photo', 'status'
    ];

    public function getCreatedAtAttribute($value)
    {
        $date = date('Y-m-d H:i:s', strtotime($value));
        return $date;
    }
    
    public function users(){
        return $this->hasMany(User::class);
    }

    public function raffles(){
        return $this->hasMany(Raffle::class);
    }
}
