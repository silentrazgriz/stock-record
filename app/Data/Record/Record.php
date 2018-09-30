<?php

namespace App\Data\Record;

use App\Data\Relationship\BelongsToQuoteTrait;
use App\Data\Relationship\BelongsToUserAccountTrait;
use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    use BelongsToQuoteTrait, BelongsToUserAccountTrait;

    protected $fillable = [
        'user_account_id', 'quote_id', 'price', 'total_shares', 'broker_fee', 'type'
    ];
}
