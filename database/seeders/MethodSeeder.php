<?php

namespace Database\Seeders;

use App\Models\Method;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $methods =  [
            [
                'id' => '2',
                'name' => 'Мультиварка',
                'coef' => '1',
            ],
            [
                'id' => '4',
                'name' => 'На зиму',
                'coef' => '1',
            ],
            [
                'id' => '7',
                'name' => 'Микроволновка',
                'coef' => '1',
            ],
            [
                'id' => '19',
                'name' => 'Духовка',
                'coef' => '0.9',
            ],
            [
                'id' => '20',
                'name' => 'Хлебопечка',
                'coef' => '1',
            ],
            [
                'id' => '21',
                'name' => 'Тушение',
                'coef' => '0.85',
            ],
            [
                'id' => '22',
                'name' => 'Кастрюля',
                'coef' => '0.9',
            ],
            [
                'id' => '23',
                'name' => 'Без выпечки',
                'coef' => '1',
            ],
            [
                'id' => '24',
                'name' => 'В пакете',
                'coef' => '0.95',
            ],
            [
                'id' => '25',
                'name' => 'Сковорода',
                'coef' => '1.2',
            ],
            [
                'id' => '27',
                'name' => 'Маринование',
                'coef' => '1',
            ],
            [
                'id' => '28',
                'name' => 'Засолка',
                'coef' => '1',
            ],
            [
                'id' => '29',
                'name' => 'Мангал',
                'coef' => '1.1',
            ],
            [
                'id' => '30',
                'name' => 'Электрогриль',
                'coef' => '1',
            ],
            [
                'id' => '31',
                'name' => 'Аэрогриль',
                'coef' => '1',
            ],
            [
                'id' => '32',
                'name' => 'В фольге',
                'coef' => '1',
            ],
            [
                'id' => '33',
                'name' => 'В рукаве',
                'coef' => '1',
            ],
            [
                'id' => '34',
                'name' => 'На пару',
                'coef' => '0.95',
            ],
            [
                'id' => '35',
                'name' => 'Вафельница',
                'coef' => '1',
            ],
            [
                'id' => '36',
                'name' => 'В банке',
                'coef' => '1',
            ],
            [
                'id' => '37',
                'name' => 'Скороварка',
                'coef' => '1',
            ],
            [
                'id' => '38',
                'name' => 'Гриль',
                'coef' => '1',
            ],
            [
                'id' => '39',
                'name' => 'Панировка',
                'coef' => '1',
            ],
            [
                'id' => '40',
                'name' => 'Формочки',
                'coef' => '1',
            ],
            [
                'id' => '41',
                'name' => 'Бумажные формочки',
                'coef' => '1',
            ],
            [
                'id' => '42',
                'name' => 'Литровые банки',
                'coef' => '1',
            ],
            [
                'id' => '43',
                'name' => 'Горячий способ',
                'coef' => '1',
            ],
            [
                'id' => '44',
                'name' => 'Железные крышки',
                'coef' => '1',
            ],
            [
                'id' => '45',
                'name' => 'Без стерилизации',
                'coef' => '1',
            ],
            [
                'id' => '46',
                'name' => '3-х литровая банка',
                'coef' => '1',
            ],
            [
                'id' => '47',
                'name' => 'Кружочками',
                'coef' => '1',
            ],
            [
                'id' => '48',
                'name' => 'Резаные',
                'coef' => '1',
            ],
            [
                'id' => '49',
                'name' => 'Холодный способ',
                'coef' => '1',
            ],
            [
                'id' => '50',
                'name' => 'Капроновые крышки',
                'coef' => '1',
            ],
            [
                'id' => '51',
                'name' => '1.5 л. банки',
                'coef' => '1',
            ],
            [
                'id' => '52',
                'name' => 'Стерилизация',
                'coef' => '1',
            ],
            [
                'id' => '53',
                'name' => '2л. банка',
                'coef' => '1',
            ],
            [
                'id' => '55',
                'name' => 'Сразу есть',
                'coef' => '1',
            ],
            [
                'id' => '56',
                'name' => 'Заварной крем',
                'coef' => '1',
            ],
            [
                'id' => '57',
                'name' => 'Без раскатки коржей',
                'coef' => '1',
            ],
            [
                'id' => '58',
                'name' => 'С припеком',
                'coef' => '1',
            ],
            [
                'id' => '59',
                'name' => 'Заварные',
                'coef' => '1',
            ],
            [
                'id' => '60',
                'name' => 'Без косточки',
                'coef' => '1',
            ],
            [
                'id' => '61',
                'name' => 'С косточкой',
                'coef' => '1',
            ],
            [
                'id' => '62',
                'name' => 'Пятиминутка',
                'coef' => '1',
            ],
            [
                'id' => '63',
                'name' => 'Мясорубка',
                'coef' => '1',
            ],
            [
                'id' => '64',
                'name' => 'Блендер',
                'coef' => '1',
            ],
            [
                'id' => '65',
                'name' => 'Без варки',
                'coef' => '1',
            ],
            [
                'id' => '66',
                'name' => 'Дольками',
                'coef' => '1',
            ],
            [
                'id' => '68',
                'name' => 'Сушилка',
                'coef' => '1.5',
            ],
            [
                'id' => '69',
                'name' => 'Дегидратор',
                'coef' => '1.3',
            ],
            [
                'id' => '70',
                'name' => 'В бочке',
                'coef' => '1',
            ],
            [
                'id' => '71',
                'name' => 'В ведре',
                'coef' => '1',
            ],
            [
                'id' => '72',
                'name' => 'С варкой',
                'coef' => '0.9',
            ],
            [
                'id' => '73',
                'name' => 'В 3-х литровых банках',
                'coef' => '1',
            ],
            [
                'id' => '74',
                'name' => 'Без косточек',
                'coef' => '1',
            ],
            [
                'id' => '75',
                'name' => 'С косточками',
                'coef' => '1',
            ],
            [
                'id' => '76',
                'name' => 'Котлеты',
                'coef' => '1',
            ],
            [
                'id' => '77',
                'name' => 'Ленивые голубцы слоями',
                'coef' => '1',
            ],
            [
                'id' => '78',
                'name' => 'Казан',
                'coef' => '1.1',
            ],
            [
                'id' => '80',
                'name' => 'Фритюрница',
                'coef' => '1.1',
            ],
            [
                'id' => '81',
                'name' => 'Термомикс',
                'coef' => '1',
            ],
            [
                'id' => '82',
                'name' => 'Автоклав',
                'coef' => '1',
            ],
            [
                'id' => '84',
                'name' => 'Соковыжималка',
                'coef' => '1',
            ],
            [
                'id' => '85',
                'name' => 'Соковарка',
                'coef' => '1',
            ],
            [
                'id' => '88',
                'name' => 'Без обжарки',
                'coef' => '1',
            ],
            [
                'id' => '89',
                'name' => 'Кусочками',
                'coef' => '1',
            ],
            [
                'id' => '90',
                'name' => 'Быстрого приготовления',
                'coef' => '1',
            ],
            [
                'id' => '91',
                'name' => 'Кольцами',
                'coef' => '1',
            ],
            [
                'id' => '92',
                'name' => 'Пресс',
                'coef' => '1',
            ],
            [
                'id' => '93',
                'name' => 'Сито',
                'coef' => '1',
            ],
            [
                'id' => '94',
                'name' => 'В горшочках',
                'coef' => '1',
            ],
            [
                'id' => '95',
                'name' => 'Кокотницы',
                'coef' => '1',
            ],
            [
                'id' => '96',
                'name' => 'Целиком',
                'coef' => '1',
            ],
            [
                'id' => '97',
                'name' => 'Стейки',
                'coef' => '1',
            ],
            [
                'id' => '98',
                'name' => 'Под прессом',
                'coef' => '1',
            ],
            [
                'id' => '99',
                'name' => 'На костре',
                'coef' => '1',
            ],
            [
                'id' => '100',
                'name' => 'В рассоле',
                'coef' => '1',
            ],
            [
                'id' => '101',
                'name' => 'Сухой посол',
                'coef' => '1',
            ],
            [
                'id' => '102',
                'name' => 'Без замачивания',
                'coef' => '1',
            ],
            [
                'id' => '103',
                'name' => 'С замачиванием',
                'coef' => '1',
            ],
            [
                'id' => '104',
                'name' => 'Утятница',
                'coef' => '1',
            ],
            [
                'id' => '105',
                'name' => 'Мантоварка',
                'coef' => '1',
            ],
            [
                'id' => '106',
                'name' => 'Куском',
                'coef' => '1',
            ],
            [
                'id' => '107',
                'name' => 'На пергаменте',
                'coef' => '1',
            ],
            [
                'id' => '108',
                'name' => 'На противне',
                'coef' => '1',
            ],
            [
                'id' => '109',
                'name' => 'С хрустящей корочкой',
                'coef' => '1',
            ],
            [
                'id' => '110',
                'name' => 'На плите',
                'coef' => '1',
            ],
            [
                'id' => '111',
                'name' => 'Стеклянная посуда',
                'coef' => '1',
            ],
            [
                'id' => '112',
                'name' => 'Вок',
                'coef' => '1',
            ],
            [
                'id' => '113',
                'name' => 'Жаровня',
                'coef' => '1',
            ],
            [
                'id' => '114',
                'name' => 'Мультиварка Редмонд',
                'coef' => '1',
            ],
            [
                'id' => '115',
                'name' => 'Мультиварка Поларис',
                'coef' => '1',
            ],
            [
                'id' => '116',
                'name' => 'Мультиварка Панасоник',
                'coef' => '1',
            ],
            [
                'id' => '117',
                'name' => 'На кипятке',
                'coef' => '1',
            ],
            [
                'id' => '118',
                'name' => 'Без кожуры',
                'coef' => '1',
            ],
            [
                'id' => '119',
                'name' => 'С кожурой',
                'coef' => '1',
            ],
            [
                'id' => '120',
                'name' => 'Бутылка',
                'coef' => '1',
            ],
            [
                'id' => '121',
                'name' => 'Решетка',
                'coef' => '1',
            ],
            [
                'id' => '122',
                'name' => 'В собственном соку',
                'coef' => '1',
            ],
            [
                'id' => '123',
                'name' => 'Заморозка',
                'coef' => '1',
            ],
            [
                'id' => '124',
                'name' => 'Для холодильника',
                'coef' => '1',
            ],
            [
                'id' => '126',
                'name' => 'За 10 минут',
                'coef' => '1',
            ],
            [
                'id' => '127',
                'name' => '15 минут',
                'coef' => '1',
            ],
            [
                'id' => '128',
                'name' => 'За 5 минут',
                'coef' => '1',
            ],
            [
                'id' => '129',
                'name' => 'В сиропе',
                'coef' => '1',
            ],
            [
                'id' => '130',
                'name' => 'Undefined',
                'coef' => '1',
            ],
            [
                'id' => '131',
                'name' => 'Тарталетки',
                'coef' => '1',
            ],
            [
                'id' => '132',
                'name' => 'Холодное копчение',
                'coef' => '1',
            ],
            [
                'id' => '133',
                'name' => 'Горячее копчение',
                'coef' => '1',
            ],
            [
                'id' => '134',
                'name' => 'Миксер',
                'coef' => '1',
            ],
        ];

        foreach ($methods as $method) {
            Method::create($method);
        }
    }
}
