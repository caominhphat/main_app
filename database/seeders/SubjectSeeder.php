<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('subjects')->insert([
                [
                    'name' => 'Toan cao cap',
                ],
                [
                    'name' => 'Van hoc',
                ],
                [
                    'name' => 'Hoa hoc',
                ]
            ]
        );
    }
}
