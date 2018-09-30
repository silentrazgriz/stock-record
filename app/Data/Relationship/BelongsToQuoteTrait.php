<?php

declare(strict_types=1);


namespace App\Data\Relationship;


use App\Component\Relationship\RelationshipTrait;
use App\Data\Quote\Quote;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Trait BelongsToQuoteTrait
 * @package App\Data\Relationship
 */
trait BelongsToQuoteTrait
{
    use RelationshipTrait;

    /**
     * @return BelongsTo
     */
    public function quote(): BelongsTo
    {
        return $this->belongsTo(Quote::class, 'quote_id');
    }
}