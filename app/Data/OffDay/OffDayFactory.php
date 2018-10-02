<?php

declare(strict_types=1);

namespace App\Data\OffDay;

final class OffDayFactory
{
    /**
     * @param array $payload
     * @return OffDay
     */
    public function create(array $payload): OffDay
    {
        $offDay = new OffDay();

        $offDay->off_date = $payload['off_date'];

        return $offDay;
    }

    /**
     * @param OffDay $offDay
     * @param array $payload
     * @return OffDay
     */
    public function update(OffDay $offDay, array $payload): OffDay
    {
        $offDay->off_date = $payload['off_date'] ?? $offDay->off_date;

        return $offDay;
    }
}