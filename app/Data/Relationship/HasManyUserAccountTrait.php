<?php

declare(strict_types=1);


namespace App\Data\Relationship;


use App\Component\Relationship\RelationshipTrait;
use App\Data\UserAccount\UserAccount;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Trait HasManyAccountTrait
 * @package App\Data\Relationship
 */
trait HasManyUserAccountTrait
{
    use RelationshipTrait;

    /**
     * @return HasMany
     */
    public function userAccounts(): HasMany
    {
        return $this->hasMany(UserAccount::class);
    }
}