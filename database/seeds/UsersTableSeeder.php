<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'Valentino Ekaputra',
                'email' => 'valentino.ekaputra@live.com',
                'login_id' => 'VAPA93',
                'password' => bcrypt('secret'),
            ]
        ]);
    }
}
