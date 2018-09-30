<?php

declare(strict_types=1);


namespace App\Component\Model;


use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

/**
 * Class UuidModel
 * @package App\Component\Model
 */
class UuidModel extends Model
{
    /**
     * @var bool
     */
    public $incrementing = false;

    /**
     * Boot function from laravel.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->{$model->getKeyName()} = Uuid::uuid4();
        });
    }
}