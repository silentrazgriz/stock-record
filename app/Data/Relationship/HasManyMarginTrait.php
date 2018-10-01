<?php

declare(strict_types=1);


namespace App\Data\Relationship;


use App\Component\Relationship\RelationshipTrait;
use App\Data\Margin\Margin;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait HasManyMarginTrait
{
    use RelationshipTrait;

    public function margins(): HasMany
    {
        return $this->hasMany(Margin::class);
    }
}