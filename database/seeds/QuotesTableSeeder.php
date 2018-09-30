<?php

use GuzzleHttp\Client;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuotesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $client = new Client();
        $response = $client->request('GET', $this->getSummaryUrl());
        $json = json_decode($response->getBody());
        $inserted = [];
        foreach ($json->data as $data) {
            $inserted[] = [
                'code' => $data->StockCode,
                'name' => $data->StockName,
                'previous' => $data->Previous,
                'close' => $data->Close,
                'low' => $data->Low == 0 ? $data->Close : $data->Low,
                'high' => $data->High == 0 ? $data->Close : $data->High,
                'change' => $data->Change,
                'listed_shares' => $data->ListedShares,
                'volume' => $data->Volume,
                'foreign_buy' => $data->ForeignBuy,
                'foreign_sell' => $data->ForeignSell
            ];
        }
        DB::table('quotes')->insert($inserted);
    }

    public function getSummaryUrl() {
        return 'http://www.idx.co.id/umbraco/Surface/TradingSummary/GetStockSummary?draw=1&start=0&length=700';
    }
}
