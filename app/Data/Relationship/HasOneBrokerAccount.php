<?php

declare(strict_types=1);


namespace App\Data\Relationship;


use App\Component\Relationship\RelationshipTrait;
use App\Data\BrokerAccount\BrokerAccount;
use Illuminate\Database\Eloquent\Relations\HasOne;

trait HasOneBrokerAccount
{
    use RelationshipTrait;

    public function brokerAccount(): HasOne
    {
        return $this->hasOne(BrokerAccount::class);
    }
}