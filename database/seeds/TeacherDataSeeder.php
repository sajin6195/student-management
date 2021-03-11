<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Teacher;

class TeacherDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement ('SET FOREIGN_KEY_CHECKS=0;');
        Teacher::truncate();
        $data = [
        	[
        		'id' => '1',
        		'name' => 'Katie',
        	],
        	[
        		'id' => '2',
        		'name' => 'Max',
        	]
        ];
        Teacher::insert($data);
    }
}
