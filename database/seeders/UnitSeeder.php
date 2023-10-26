<?php

namespace Database\Seeders;

use App\Models\Unit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $units = [
            [
                'id' => '1',
                'name' => 'шт.',
                'weight' => '14',
            ],
            [
                'id' => '3',
                'name' => 'кг',
                'weight' => '1000',
            ],
            [
                'id' => '4',
                'name' => 'гр.',
                'weight' => '1',
            ],
            [
                'id' => '5',
                'name' => 'мл.',
                'weight' => '1',
            ],
            [
                'id' => '6',
                'name' => 'ч.л.',
                'weight' => '6',
            ],
            [
                'id' => '7',
                'name' => 'ст.л.',
                'weight' => '15',
            ],
            [
                'id' => '8',
                'name' => 'ст.',
                'weight' => '200',
            ],
            [
                'id' => '9',
                'name' => 'л.',
                'weight' => '1000',
            ],
            [
                'id' => '10',
                'name' => 'щепотка',
                'weight' => '1',
                'form_word' => 'щепотка;щепотки;щепоток',
            ],
            [
                'id' => '11',
                'name' => 'зуб.',
                'weight' => '4',
            ],
            [
                'id' => '12',
                'name' => 'см.',
                'weight' => '8',
            ],
            [
                'id' => '13',
                'name' => 'по вкусу',
                'weight' => '8',
            ],
            [
                'id' => '14',
                'name' => 'для жарки',
                'weight' => '80',
            ],
            [
                'id' => '15',
                'name' => 'по желанию',
                'weight' => '6',
            ],
            [
                'id' => '17',
                'name' => 'для смазывания',
                'weight' => '10',
            ],
            [
                'id' => '18',
                'name' => 'для посыпки',
                'weight' => '10',
            ],
            [
                'id' => '19',
                'name' => 'для украшения',
                'weight' => '15',
            ],
            [
                'id' => '21',
                'name' => 'на кончике ножа',
                'weight' => '2',
            ],
            [
                'id' => '23',
                'name' => 'ветка',
                'weight' => '11',
                'form_word' => 'ветка;ветки;веток',
            ],
            [
                'id' => '24',
                'name' => 'пакет',
                'weight' => '10',
                'form_word' => 'пакет;пакета;пакетов',
            ],
            [
                'id' => '26',
                'name' => 'пучок',
                'weight' => '22',
                'form_word' => 'пучoк;пучка;пучков',
            ],
            [
                'id' => '27',
                'name' => 'банка',
                'weight' => '450',
                'form_word' => 'банка;банки;банок',
            ],
            [
                'id' => '28',
                'name' => 'горсть',
                'weight' => '30',
                'form_word' => 'горсть;горсти;горстей',
            ],
            [
                'id' => '29',
                'name' => 'кусок',
                'weight' => '200',
                'form_word' => 'кусок;куска;кусков',
            ],
            [
                'id' => '32',
                'name' => 'палочка',
                'weight' => '7',
                'form_word' => 'палочка;палочки;палочек',
            ],
            [
                'id' => '33',
                'name' => 'звезда',
                'weight' => '12',
                'form_word' => 'звезда;звезды;звезд',
            ],
            [
                'id' => '36',
                'name' => 'кружок',
                'weight' => '20',
                'form_word' => 'кружок;кружка;кружков',
            ],
            [
                'id' => '37',
                'name' => 'бутон',
                'weight' => '3',
                'form_word' => 'бутон;бутона;бутонов',
            ],
            [
                'id' => '38',
                'name' => 'долька',
                'weight' => '7',
                'form_word' => 'долька;дольки;долек',
            ],
            [
                'id' => '39',
                'name' => 'мультистакан',
                'weight' => '210',
                'form_word' => 'мультистакан;мультистакана;мультистаканов',
            ],
            [
                'id' => '51',
                'name' => 'перо',
                'weight' => '1.5',
                'form_word' => 'перо;пера;перьев',
            ],
            [
                'id' => '54',
                'name' => 'капли',
                'weight' => '1.2',
                'form_word' => 'капли;капли;капель',
            ],
            [
                'id' => '55',
                'name' => 'лист',
                'weight' => '25',
                'form_word' => 'лист;листа;листьев',
            ],
            [
                'id' => '56',
                'name' => 'пачка',
                'weight' => '200',
                'form_word' => 'пачка;пачки;пачек',
            ],
            [
                'id' => '57',
                'name' => 'головка',
                'weight' => '80',
                'form_word' => 'головка;головки;головок',
            ],
            [
                'id' => '58',
                'name' => 'ломтик',
                'weight' => '14',
                'form_word' => 'ломтик;ломтика;ломтиков',
            ],
        ];

        foreach ($units as $unit) {
            Unit::create($unit);
        }
    }
}
