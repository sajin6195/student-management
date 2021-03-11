<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\User;

class AdminDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        $data = [
        	[
        		'id' => '1',
        		'name' => 'Admin',
        		'email' => 'admin@email.com',
        		'password' => Hash::make('12345678'),
        	]
        ];
        User::insert($data);
    }
}
