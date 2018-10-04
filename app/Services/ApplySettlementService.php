<?php

declare(strict_types=1);

namespace App\Services;

use App\Data\Margin\MarginRepository;
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
     * @var MarginRepository
     */
    private $marginRepository;

    /**
     * ApplySettlementService constructor.
     * @param SettlementRepository $settlementRepository
     * @param MarginRepository $marginRepository
     */
    public function __construct(
        SettlementRepository $settlementRepository,
        MarginRepository $marginRepository
    ) {
        $this->settlementRepository = $settlementRepository;
        $this->marginRepository = $marginRepository;
    }

    /**
     *
     */
    public function apply()
    {
    }
}