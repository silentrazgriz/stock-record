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
        $sectors = [
            "AGRI",
            "BASIC-IND",
            "CONSUMER",
            "FINANCE",
            "INFRASTRUCT",
            "MINING",
            "MISC-IND",
            "PROPERTY",
            "TRADE"
        ];

        $customDate = [
            'BNBA' => '2006-06-01T00:00:00',
            'BRIS' => '2018-05-09T00:00:00',
            'SCBD' => '2002-04-19T00:00:00',
            'PANR' => '2001-09-18T00:00:00'
        ];

        $client = new Client();
        foreach ($sectors as $sector) {
            $response = $client->request('GET', $this->getStockUrl($sector));
            $json = json_decode($response->getBody());
            $inserted = [];
            foreach ($json->data as $data) {
                $inserted[] = [
                    'sector' => $sector,
                    'code' => $data->Code,
                    'name' => $data->Name,
                    'listing_date' => date('Y-m-d H:i:s', strtotime(isset($customDate[$data->Code]) ? $customDate[$data->Code] : $data->ListingDate)),
                ];
            }
            DB::table('quotes')->insert($inserted);
        }
    }

    public function getStockUrl($sector, $length = 150) {
        return 'http://www.idx.co.id/umbraco/Surface/StockData/GetSecuritiesStock?code=&sector=' . $sector . '&board=&draw=6&start=0&length=' . $length;
    }
}
