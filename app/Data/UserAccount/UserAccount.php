<?php

declare(strict_types=1);


namespace App\Data\UserAccount;


use App\Data\Relationship\BelongsToBrokerAccountTrait;
use App\Data\Relationship\BelongsToUserTrait;
use App\Data\Relationship\HasManyMarginTrait;
use App\Data\Relationship\HasManySettlementTrait;
use App\Data\Relationship\HasManyRecordTrait;
use App\Data\Relationship\HasManySummaryTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserAccount extends Model
{
    use BelongsToUserTrait, BelongsToBrokerAccountTrait, HasManyRecordTrait, HasManyMarginTrait,
        HasManySettlementTrait, HasManySummaryTrait, SoftDeletes;

    protected $fillable = [
        'user_id', 'broker_account_id', 'name', 'balance', 'balance_updated_at'
    ];
}