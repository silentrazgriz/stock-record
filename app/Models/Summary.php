<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Summary extends Model
{
    protected $fillable = [
        'quote_id', 'previous', 'open', 'close', 'low', 'high', 'change', 'listed_shares', 'volume', 'foreign_buy', 'foreign_sell'
    ];

    public function quote() {
        return $this->belongsTo(Quote::class, 'quote_id');
    }
}
