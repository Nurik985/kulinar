<?php

namespace Database\Seeders;

use App\Models\CalcColumn;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CalcColumnSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $calcColumns = [
            [
                'id' => '40',
                'name' => 'ст.',
                'param' => '11',
            ],
            [
                'id' => '42',
                'name' => 'ч.л.',
                'param' => '13',
            ],
            [
                'id' => '43',
                'name' => 'шт.',
                'param' => '14',
            ],
            [
                'id' => '44',
                'name' => 'по вкусу',
                'param' => '15',
            ],
            [
                'id' => '45',
                'name' => 'ст.л.',
                'param' => '11',
            ],
            [
                'id' => '46',
                'name' => 'банка',
                'param' => '16',
            ],
            [
                'id' => '50',
                'name' => 'лист',
                'param' => '20',
            ],
            [
                'id' => '51',
                'name' => 'пакет',
                'param' => '22',
            ],
            [
                'id' => '52',
                'name' => 'головка',
                'param' => '21',
            ],
            [
                'id' => '53',
                'name' => 'пачка',
                'param' => '22',
            ],
            [
                'id' => '55',
                'name' => 'ломтик',
                'param' => '23',
            ],
            [
                'id' => '60',
                'name' => 'ветка',
                'param' => '24',
            ],
        ];

        foreach ($calcColumns as $calcColumn) {
            CalcColumn::create($calcColumn);
        }
    }
}
