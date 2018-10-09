<?php

declare(strict_types=1);

namespace App\Services;

use App\Data\Quote\QuoteRepository;
use GuzzleHttp\Client;

/**
 * Class QuoteService
 * @package App\Services
 */
final class QuoteService
{
    /**
     * @var QuoteRepository
     */
    private $quoteRepository;

    /**
     * QuoteService constructor.
     * @param QuoteRepository $quoteRepository
     */
    public function __construct(
        QuoteRepository $quoteRepository
    ) {
        $this->quoteRepository = $quoteRepository;
    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function updateQuote()
    {
        $client = new Client();
        $response = $client->request(
            'GET',
            'http://www.idx.co.id/umbraco/Surface/TradingSummary/GetStockSummary?draw=1&start=0&length=700'
        );
        $json = json_decode($response->getBody());
        foreach ($json->data as $data) {
            $quotes = $this->quoteRepository->find(['code' => $data->stockCode]);
            
            $this->quoteRepository->update($quotes[0]->id, [
                'previous' => $data->Previous,
                'close' => $data->Close,
                'low' => $data->Low == 0 ? $data->Close : $data->Low,
                'high' => $data->High == 0 ? $data->Close : $data->High,
                'change' => $data->Change,
                'volume' => $data->Volume,
                'foreign_buy' => $data->ForeignBuy,
                'foreign_sell' => $data->ForeignSell,
            ]);
        }
    }
}