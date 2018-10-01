<?php

use Illuminate\Database\Seeder;

class UserAccountsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_accounts')->insert([
            [
                'user_id' => 1,
                'broker_account_id' => 1,
                'name' => 'VAPA93 - Mirae Reguler',
                'balance' => 10000000,
            ]
        ]);
    }
}
