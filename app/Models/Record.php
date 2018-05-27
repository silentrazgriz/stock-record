<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    protected $fillable = [
        'account_id', 'quote_id', 'price', 'total_shares', 'broker_fee', 'action'
    ];

    public function account() {
        return $this->belongsTo(Account::class, 'account_id');
    }

    public function quote() {
        return $this->belongsTo(Quote::class, 'quote_id');
    }
}
