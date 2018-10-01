<?php

declare(strict_types=1);


namespace App\Data\Summary;


use App\Data\Relationship\BelongsToQuoteTrait;
use App\Data\Relationship\BelongsToUserAccountTrait;
use Illuminate\Database\Eloquent\Model;

class Summary extends Model
{
    use BelongsToUserAccountTrait, BelongsToQuoteTrait;

    protected $fillable = [
        'user_account_id', 'quote_id', 'average_price', 'total_shares'
    ];
}