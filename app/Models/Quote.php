<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    protected $fillable = [
        'sector', 'code', 'name', 'listing_date'
    ];
}
