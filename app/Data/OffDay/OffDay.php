<?php
declare(strict_types=1);


namespace App\Data\OffDay;


use Illuminate\Database\Eloquent\Model;

class OffDay extends Model
{
    protected $fillable = [
        'off_date'
    ];
}