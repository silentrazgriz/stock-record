<?php

namespace App\Data\BrokerAccount;

use App\Data\Relationship\BelongsToUserTrait;
use App\Data\Relationship\HasManyRecordTrait;
use App\Data\Relationship\HasManyUserAccountTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BrokerAccount extends Model
{
    use HasManyUserAccountTrait, SoftDeletes;

    protected $fillable = [
        'code', 'name', 'buy_commission', 'sell_commission', 'margin_interest'
    ];
}
