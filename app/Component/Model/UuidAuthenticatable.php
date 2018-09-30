<?php

declare(strict_types=1);


namespace App\Component\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Ramsey\Uuid\Uuid;


/**
 * Class UuidAuthenticatable
 * @package App\Component\Model
 */
class UuidAuthenticatable extends Authenticatable
{
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