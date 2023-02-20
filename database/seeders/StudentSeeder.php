<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        DB::table('students')->insert(
            [
                [
                    'name' => 'cao minh phat',
                    'birth_day' => \DateTime::createFromFormat(config("constants.DATE_FORMAT_DB"), '1999-10-27'),
                ],
                [
                    'name' => 'nguyen hoang phuong uyen',
                    'birth_day' => \DateTime::createFromFormat(config("constants.DATE_FORMAT_DB"), '2003-10-03'),
                ],
                [
                    'name' => 'nguyen van dau',
                    'birth_day' => \DateTime::createFromFormat(config("constants.DATE_FORMAT_DB"), '1999-11-27'),
                ]
            ]

        );

    }
}
