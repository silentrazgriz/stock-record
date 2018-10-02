<?php

declare(strict_types=1);


namespace App\Data\Settlement;


use App\Data\Relationship\BelongsToUserAccountTrait;
use Illuminate\Database\Eloquent\Model;

class Settlement extends Model
{
    use BelongsToUserAccountTrait;

    protected $fillable = [
        'user_account_id', 'amount', 'transaction_at', 'realization_at'
    ];
}