<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $fillable = [
        'user_id', 'code', 'name', 'buy_commission', 'sell_commission', 'is_default'
    ];

    protected $hidden = [
        'is_default'
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function records() {
        return $this->hasMany(Record::class, 'account_id');
    }
}
