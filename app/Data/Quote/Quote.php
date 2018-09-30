<?php

namespace App\Data\Quote;

use App\Data\Relationship\HasManyRecordTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Quote extends Model
{
    use HasManyRecordTrait, SoftDeletes;

    protected $fillable = [
        'sector', 'code', 'name', 'previous', 'close', 'low', 'high', 'change', 'listed_share', 'volume',
        'foreign_buy', 'foreign_sell'
    ];
}
