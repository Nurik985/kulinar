<?php

namespace Database\Seeders;

use App\Models\MineralColumn;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MineralColumnSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $mineralColumns = [
            [
                'id' => '728',
                'name' => 'А',
            ],
            [
                'id' => '729',
                'name' => 'В1',
            ],
            [
                'id' => '730',
                'name' => 'В2',
            ],
            [
                'id' => '731',
                'name' => 'В4',
            ],
            [
                'id' => '732',
                'name' => 'В5',
            ],
            [
                'id' => '733',
                'name' => 'В6',
            ],
            [
                'id' => '734',
                'name' => 'В9',
            ],
            [
                'id' => '735',
                'name' => 'B12',
            ],
            [
                'id' => '736',
                'name' => 'C',
            ],
            [
                'id' => '737',
                'name' => 'D',
            ],
            [
                'id' => '738',
                'name' => 'Е',
            ],
            [
                'id' => '739',
                'name' => 'Н',
            ],
            [
                'id' => '740',
                'name' => 'К',
            ],
            [
                'id' => '741',
                'name' => 'РР, НЭ',
            ],
            [
                'id' => '742',
                'name' => 'Калий, K',
            ],
            [
                'id' => '743',
                'name' => 'Кальций, Ca',
            ],
            [
                'id' => '744',
                'name' => 'Кремний, Si',
            ],
            [
                'id' => '745',
                'name' => 'Магний, Mg',
            ],
            [
                'id' => '746',
                'name' => 'Натрий, Na',
            ],
            [
                'id' => '747',
                'name' => 'Сера, S',
            ],
            [
                'id' => '748',
                'name' => 'Фосфор, P',
            ],
            [
                'id' => '749',
                'name' => 'Хлор, Cl',
            ],
            [
                'id' => '750',
                'name' => 'Алюминий, Al',
            ],
            [
                'id' => '751',
                'name' => 'Железо, Fe',
            ],
            [
                'id' => '752',
                'name' => 'Йод, I',
            ],
            [
                'id' => '753',
                'name' => 'Кобальт, Co',
            ],
            [
                'id' => '754',
                'name' => 'Литий, Li',
            ],
            [
                'id' => '755',
                'name' => 'Марганец, Mn',
            ],
            [
                'id' => '756',
                'name' => 'Медь, Cu',
            ],
            [
                'id' => '757',
                'name' => 'Никель, Ni',
            ],
            [
                'id' => '758',
                'name' => 'Рубидий, Rb',
            ],
            [
                'id' => '759',
                'name' => 'Селен, Se',
            ],
            [
                'id' => '760',
                'name' => 'Фтор, F',
            ],
            [
                'id' => '761',
                'name' => 'Хром, Cr',
            ],
            [
                'id' => '762',
                'name' => 'Цинк, Zn',
            ],
            [
                'id' => '763',
                'name' => 'Бор, B',
            ],
            [
                'id' => '764',
                'name' => 'Ванадий, V',
            ],
            [
                'id' => '765',
                'name' => 'Молибден, Mo',
            ],
        ];

        foreach ($mineralColumns as $mineralColumn) {
            MineralColumn::create($mineralColumn);
        }
    }
}
