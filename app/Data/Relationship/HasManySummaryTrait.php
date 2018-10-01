<?php

declare(strict_types=1);


namespace App\Data\Relationship;


use App\Component\Relationship\RelationshipTrait;
use App\Data\Summary\Summary;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait HasManySummaryTrait
{
    use RelationshipTrait;

    public function summaries(): HasMany
    {
        return $this->hasMany(Summary::class);
    }
}