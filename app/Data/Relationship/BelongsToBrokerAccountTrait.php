<?php

declare(strict_types=1);


namespace App\Data\Relationship;


use App\Component\Relationship\RelationshipTrait;
use App\Data\BrokerAccount\BrokerAccount;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait BelongsToBrokerAccountTrait
{
    use RelationshipTrait;

    public function brokerAccount(): BelongsTo
    {
        return $this->belongsTo(BrokerAccount::class);
    }
}