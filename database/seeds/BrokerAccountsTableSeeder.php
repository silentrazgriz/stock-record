<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BrokerAccountsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('broker_accounts')->insert([
            [
                'code' => 'YP-Reguler',
                'name' => 'Mirae Reguler Account',
                'buy_commission' => 0.15,
                'sell_commission' => 0.25,
                'margin_interest' => 0.2,
            ],
            [
                'code' => 'YP-Margin',
                'name' => 'Mirae Margin Account',
                'buy_commission' => 0.15,
                'sell_commission' => 0.25,
                'margin_interest' => 0.05,
            ],
            [
                'code' => 'YP-DT',
                'name' => 'Mirae Day Trade Account',
                'buy_commission' => 0.08,
                'sell_commission' => 0.18,
                'margin_interest' => 0,
            ],
            [
                'code' => 'PD-Reguler',
                'name' => 'Indo Premier Reguler Account',
                'buy_commission' => 0.19,
                'sell_commission' => 0.29,
                'margin_interest' => 0.2,
            ]
        ]);
    }
}
