<?php

declare(strict_types=1);

namespace App\Services;

use App\Data\Record\Record;
use App\Data\Summary\Summary;
use App\Data\Summary\SummaryRepository;

/**
 * Class CalculateSummaryService
 * @package App\Services
 */
final class CalculateSummaryService
{
    /**
     * @var SummaryRepository
     */
    private $summaryRepository;

    /**
     * CalculateSummaryService constructor.
     * @param SummaryRepository $summaryRepository
     */
    public function __construct(
        SummaryRepository $summaryRepository
    ) {
        $this->summaryRepository = $summaryRepository;
    }

    /**
     * @param Record $record
     */
    public function store(Record $record)
    {
        $summaries = $this->summaryRepository->find(['quote_id' => $record->quote_id]);

        if ($summaries->count() == 0) {
            $this->summaryRepository->create([
                'user_account_id'   => $record->user_account_id,
                'quote_id'          => $record->quote_id,
                'average_price'     => $record->price,
                'total_shares'      => $record->total_shares
            ]);
        } else {
            $summary = $summaries[0];
            $this->summaryRepository->update($summary->id, $this->getStoreDetails($summary, $record));
        }
    }

    /**
     * @param Record $record
     */
    public function destroy(Record $record)
    {
        $summaries = $this->summaryRepository->find(['quote_id' => $record->quote_id]);

        if ($summaries->count() == 0) {
            return;
        } else {
            $summary = $summaries[0];
            $this->summaryRepository->update($summary->id, $this->getDestroyDetails($summary, $record));
        }
    }

    /**
     * @param Summary $summary
     * @param Record $record
     * @return array
     */
    private function getDestroyDetails(Summary $summary, Record $record)
    {
        $totalShares = $summary->total_shares - $record->total_shares;

        return [
            'average_price' => $totalShares == 0 ? 0 : $summary['average_price'],
            'total_shares' => $totalShares
        ];
    }

    /**
     * @param Summary $summary
     * @param Record $record
     * @return array
     */
    private function getStoreDetails(Summary $summary, Record $record)
    {
        $result = [
            'summary' => $summary->average_price * $summary->total_shares,
            'record' => $record->price * $record->total_shares,
            'total_shares' => $summary->total_shares + $record->total_shares
        ];

        return [
            'average_price' => ($result['summary'] + $result['record']) / $result['total_shares'],
            'total_shares' => $result['total_shares']
        ];
    }
}