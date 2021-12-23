<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $fillable = [
        'name', 'raffle_id'
    ];

    public function raffle(){
        return $this->belongsTo(Raffle::class);
    }
}
