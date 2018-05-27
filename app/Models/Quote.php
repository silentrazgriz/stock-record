<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    protected $fillable = [
        'sector', 'code', 'name', 'listing_date'
    ];

    public function summary() {
        return $this->hasOne(Summary::class, 'quote_id');
    }

    public function records() {
        return $this->hasMany(Record::class, 'quote_id');
    }
}
