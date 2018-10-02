<?php

declare(strict_types=1);


namespace App\Data\Relationship;


use App\Component\Relationship\RelationshipTrait;
use App\Data\Settlement\Settlement;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait HasManySettlementTrait
{
    use RelationshipTrait;

    public function settlements(): HasMany
    {
        return $this->hasMany(Settlement::class);
    }
}