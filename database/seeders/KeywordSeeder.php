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
                'id' => 1,
                'keyword' => 'Choose ...',
            ],
            [
                'id' => 2,
                'keyword' => 'Technical Problem',
            ],
            [
                'id' => 3,
                'keyword' => 'Malfunction',
            ],
            [
                'id' => 4,
                'keyword' => 'Contract problem',
            ],
        ];

        Keyword::insert($keywords);
    }
}
