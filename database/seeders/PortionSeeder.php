<?php

namespace Database\Seeders;

use App\Models\Portion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PortionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $portions = [
            [
                'id' => '2',
                'name' => 'л.',
                'sort' => '10',
            ],
            [
                'id' => '5',
                'name' => 'кг',
                'sort' => '10',
            ],
            [
                'id' => '6',
                'name' => 'см.',
                'sort' => '10',
            ],
            [
                'id' => '8',
                'name' => 'порц.',
                'sort' => '1',
            ],
            [
                'id' => '9',
                'name' => 'шт.',
                'sort' => '10',
            ],
            [
                'id' => '10',
                'name' => 'гр.',
                'sort' => '10',
            ],
            [
                'id' => '11',
                'name' => 'мл.',
                'sort' => '10',
            ],
        ];

        foreach ($portions as $portion) {
            Portion::create($portion);
        }
    }
}
