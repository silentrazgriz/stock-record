<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AccountsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('accounts')->insert([
            [
                'user_id' => 1,
                'code' => 'YP',
                'name' => 'Mirae Asset Sekuritas',
                'buy_commission' => 0.15,
                'sell_commission' => 0.25,
                'is_template' => true
            ],
            [
                'user_id' => 1,
                'code' => 'PD',
                'name' => 'Indo Premier Securities',
                'buy_commission' => 0.19,
                'sell_commission' => 0.29,
                'is_template' => true
            ]
        ]);
    }
}
