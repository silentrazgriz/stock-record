<?php

declare(strict_types=1);


namespace App\Data\Relationship;


use App\Component\Relationship\RelationshipTrait;
use App\Data\Record\Record;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait HasManyRecordTrait
{
    use RelationshipTrait;

    public function records(): HasMany
    {
        return $this->hasMany(Record::class);
    }
}