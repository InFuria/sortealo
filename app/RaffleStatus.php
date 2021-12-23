<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RaffleStatus extends Model
{
    protected $table = "raffle_statuses";

    protected $fillable = [
        'name'
    ];
}
