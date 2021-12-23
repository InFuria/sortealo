<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Raffle extends Model
{
    protected $table = "raffles";

    protected $fillable = [
        'title', 'quantity_tickets', 'cost_per_ticket', 'description', 'type_id', 'category_id', 'status', 'multiple_winners', 'extra_winners', 'start_date', 'end_date', 'raffle_date', 'company_id', 'created_by'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'start_date',
        'end_date'
    ];

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

    public function category(){
        return $this->belongsTo(RaffleCategory::class, 'category_id');
    }

    public function type(){
        return $this->belongsTo(RaffleType::class, 'type_id');
    }

    public function files(){
        return $this->hasMany(File::class);
    }

    public function clients(){
        return $this->belongsToMany(Client::class, 'raffle_clients', 'raffle_id', 'client_id');
    }

    public function creator(){
        return $this->belongsTo(User::class, 'created_by');
    }

    public function company(){
        return $this->belongsTo(Company::class);
    }
}
