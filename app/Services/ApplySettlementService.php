<?php

declare(strict_types=1);

namespace App\Services;

use App\Data\Settlement\SettlementRepository;

/**
 * Class ApplySettlementService
 * @package App\Services
 */
final class ApplySettlementService
{
    /**
     * @var SettlementRepository
     */
    private $settlementRepository;

    /**
     * ApplySettlementService constructor.
     * @param SettlementRepository $settlementRepository
     */
    public function __construct(
        SettlementRepository $settlementRepository
    ) {
        $this->settlementRepository = $settlementRepository;
    }

    /**
     *
     */
    public function apply()
    {

    }
}