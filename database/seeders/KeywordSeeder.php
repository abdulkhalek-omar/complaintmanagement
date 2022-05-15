<?php

namespace Database\Seeders;

use App\Models\Keyword;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KeywordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $keywords = [
            [
                'id' => 0,
                'keyword' => 'Choose ...',
            ],
        ];

        Keyword::insert($keywords);
    }
}
