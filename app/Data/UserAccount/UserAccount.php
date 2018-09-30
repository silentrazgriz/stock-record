<?php

declare(strict_types=1);


namespace App\Data\UserAccount;


use App\Data\Relationship\BelongsToBrokerAccountTrait;
use App\Data\Relationship\BelongsToUserTrait;
use App\Data\Relationship\HasManyRecordTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserAccount extends Model
{
    use BelongsToUserTrait, BelongsToBrokerAccountTrait, HasManyRecordTrait, SoftDeletes;

    protected $fillable = [
        'user_id', 'broker_account_id', 'name'
    ];
}