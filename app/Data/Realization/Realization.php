<?php

declare(strict_types=1);


namespace App\Data\Realization;


use App\Data\Relationship\BelongsToUserAccountTrait;
use Illuminate\Database\Eloquent\Model;

class Realization extends Model
{
    use BelongsToUserAccountTrait;

    protected $fillable = [
        'user_account_id', 'amount', 'transaction_at', 'realization_at'
    ];
}