<?php

declare(strict_types=1);


namespace App\Data\Relationship;


use App\Component\Relationship\RelationshipTrait;
use App\Data\UserAccount\UserAccount;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait BelongsToUserAccountTrait
{
    use RelationshipTrait;

    public function userAccount(): BelongsTo
    {
        return $this->belongsTo(UserAccount::class);
    }
}