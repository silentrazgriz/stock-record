<?php
declare(strict_types=1);


namespace App\Data\OffDay;


use Illuminate\Database\Eloquent\Model;

/**
 * Class OffDay
 * @package App\Data\OffDay
 */
class OffDay extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'off_date'
    ];

    /**
     * @var bool
     */
    public $timestamps = false;
}