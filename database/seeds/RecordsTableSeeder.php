<?php

use Illuminate\Database\Seeder;

class RecordsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('records')->insert([
            [
                'user_account_id' => 1,
                'quote_id' => 1,
                'price' => 11500,
                'total_shares' => 500,
                'broker_fee' => 8625,
                'type' => 'BUY',
                'transaction_date' => '2018-9-3'
            ],
            [
                'user_account_id' => 1,
                'quote_id' => 1,
                'price' => 11800,
                'total_shares' => 200,
                'broker_fee' => 3540,
                'type' => 'BUY',
                'transaction_date' => '2018-9-4'
            ],
            [
                'user_account_id' => 1,
                'quote_id' => 1,
                'price' => 11250,
                'total_shares' => 200,
                'broker_fee' => 3375,
                'type' => 'BUY',
                'transaction_date' => '2018-9-5'
            ],
            [
                'user_account_id' => 1,
                'quote_id' => 1,
                'price' => 12500,
                'total_shares' => 400,
                'broker_fee' => 12500,
                'type' => 'SELL',
                'transaction_date' => '2018-9-10'
            ],
            [
                'user_account_id' => 1,
                'quote_id' => 1,
                'price' => 13000,
                'total_shares' => 300,
                'broker_fee' => 9750,
                'type' => 'SELL',
                'transaction_date' => '2018-9-11'
            ],
            [
                'user_account_id' => 1,
                'quote_id' => 593,
                'price' => 1340,
                'total_shares' => 5000,
                'broker_fee' => 10050,
                'type' => 'BUY',
                'transaction_date' => '2018-9-14'
            ],
            [
                'user_account_id' => 1,
                'quote_id' => 593,
                'price' => 1390,
                'total_shares' => 5000,
                'broker_fee' => 17375,
                'type' => 'SELL',
                'transaction_date' => '2018-9-17'
            ],
            [
                'user_account_id' => 1,
                'quote_id' => 593,
                'price' => 1425,
                'total_shares' => 5000,
                'broker_fee' => 10688,
                'type' => 'BUY',
                'transaction_date' => '2018-9-18'
            ],
            [
                'user_account_id' => 1,
                'quote_id' => 593,
                'price' => 1400,
                'total_shares' => 5000,
                'broker_fee' => 17500,
                'type' => 'SELL',
                'transaction_date' => '2018-9-19'
            ],
            [
                'user_account_id' => 1,
                'quote_id' => 593,
                'price' => 1350,
                'total_shares' => 3000,
                'broker_fee' => 6075,
                'type' => 'BUY',
                'transaction_date' => '2018-9-20'
            ],
        ]);
    }
}
