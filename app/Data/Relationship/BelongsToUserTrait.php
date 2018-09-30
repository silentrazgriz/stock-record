<?php

declare(strict_types=1);


namespace App\Data\Relationship;


use App\Component\Relationship\RelationshipTrait;
use App\Data\User\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait BelongsToUserTrait
{
    use RelationshipTrait;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}