<?php

declare(strict_types=1);


namespace App\Data\Relationship;


use App\Component\Relationship\RelationshipTrait;
use App\Data\Realization\Realization;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait HasManyRealizationTrait
{
    use RelationshipTrait;

    public function realizations(): HasMany
    {
        return $this->hasMany(Realization::class);
    }
}