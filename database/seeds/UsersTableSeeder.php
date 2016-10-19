<?php

use Illuminate\Database\Seeder;

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
            'name' => 'teach',
            'email' => 'teach@clom-networks.com',
            'password' => bcrypt('mitsuha_icoca'),
            'is_admin' => true
        ]);
    }
}
