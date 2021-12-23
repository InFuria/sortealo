<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FaqCategory extends Model
{
    protected $table = 'faqs_categories';

    protected $fillable = [
        'name'
    ];

    public function faqs(){
        return $this->hasMany(Faq::class, 'category_id');
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
