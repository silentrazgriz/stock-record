<?php

declare(strict_types=1);


namespace App\Data\Margin;


use App\Data\Relationship\BelongsToUserAccountTrait;
use Illuminate\Database\Eloquent\Model;

class Margin extends Model
{
    use BelongsToUserAccountTrait;

    protected $fillable = [
        'user_account_id', 'total_margin', 'total_interest'
    ];
}