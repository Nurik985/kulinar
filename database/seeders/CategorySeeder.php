<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'headerMenu',
                'content' => '[{"icon":"&#127814;","name":"Салаты","url":"salaty"},{"icon":"&#127861;","name":"Первые блюда","url":"supy"},{"icon":"&#127858;","name":"Вторые блюда","url":"vtorye"},{"icon":"&#127856;","name":"Десерты","url":"deserty"},{"icon":"&#127828;","name":"Закуски","url":"zakuski"},{"icon":"&#127865;","name":"Напитки","url":"napitki"}]'
            ],
            [
                'name' => 'bannerMenu',
                'content' => '[{"name":"Салаты","selecteds":{"2373":"Салаты с курицей"}},{"name":"Супы","selecteds":{"3078":"Солянка","129":"Окрошка","2950":"Гороховый суп","4620":"Грибной суп","191":"Свекольник","182":"Холодник","3142":"Суп харчо","1697":"Холодный борщ","4197":"Лагман","1044":"Щавелевый суп","4209":"Шурпа","1631":"Гаспачо"}},{"name":"Вторые блюда","selecteds":{"2737":"Плов","4462":"Каши","1313":"Овощное рагу","4199":"Отбивные","1837":"Фунчоза","4182":"Картофельная запеканка","4159":"Вареники","4002":"Гуляш","2482":"Утка в духовке","714":"Лазанья","4619":"Курица","4189":"Куриная печень","693":"Жульен","4134":"Куриные крылышки","4205":"Блюда из свинины","4412":"Куриные отбивные","741":"Ленивые голубцы","4135":"Паста карбонара","1888":"Ежики из фарша","4183":"Запеканка из макарон","2104":"Бешбармак","2121":"Шулюм","4133":"Клецки","4615":"Индейка","4212":"Ханум","4612":"Котлеты"}},{"name":"Выпечка","selecteds":{"4309":"Тесто в домашних условиях","211":"Кексы","4321":"Пироги","2524":"Оладьи","568":"Блины","876":"Пасхальные куличи","499":"Творожная запеканка","822":"Манник","461":"Шарлотка","3960":"Бисквит","1745":"Маффины","4609":"Хлеб в домашних условиях","790":"Хачапури","3348":"Беляши","4126":"Пицца домашняя","4204":"Самса","4213":"Чебуреки","2340":"Курник","4198":"Лепешки","4215":"Капкейки","4207":"Сосиски в тесте","4195":"Кыстыбый","3367":"Вак-беляши","4610":"Эклеры"}},{"name":"Закуски","selecteds":{"4537":"Рулет из лаваша","2198":"Холодец","295":"Малосольные огурцы","937":"Малосольные помидоры","4608":"Засолка рыбы","2147":"Как засолить сало в домашних условиях","4557":"Маринованная капуста","1812":"Печеночный торт","4054":"Гренки из хлеба","2162":"Соленая икра","4611":"Шаурма"}},{"name":"Напитки","selecteds":{"4586":"Компоты","884":"Хлебный квас","4206":"Смузи","4186":"Молочный коктейль"}},{"name":"Десерты","selecteds":{"4597":"Торты","2090":"Крем для торта","400":"Чизкейки","543":"Медовик","863":"Меренговый рулет","3409":"Цукаты из тыквы в духовке"}},{"name":"Заготовки на зиму","selecteds":{"4589":"Джемы","4262":"Помидоры на зиму","1796":"Кабачки на зиму","4261":"Огурцы на зиму","1793":"Сливы на зиму","1792":"Абрикосы на зиму","1507":"Салаты на зиму","4617":"Клубника на зиму","4587":"Желе на зиму","1787":"Вишня на зиму","4594":"Повидло","1789":"Красная смородина на зиму","1790":"Малина на зиму","1683":"Баклажаны на зиму","1788":"Черная смородина на зиму","1456":"Лечо","1409":"Аджика","1791":"Черешня на зиму","1794":"Черника на зиму","939":"Вяленые помидоры","1795":"Ежевика на зиму","127":"Ревень на зиму","1798":"Кизил на зиму","1042":"Щавель на зиму","4616":"Варенье"}}]'
            ],
            [
                'name' => 'sideBarMenu',
                'content' => '[{"block":{"name":"Выпечка","menu":[{"name":"Кексы","selecteds":{"211":"Кексы","212":"Кексы в духовке","215":"Кексы на кефире","213":"Творожные кексы","223":"Кексы на молоке","217":"Кексы с изюмом","216":"Шоколадные кексы","218":"Кексы в кружке за 5 минут в микроволновке","227":"Кексы на сметане","231":"Лимонные кексы"}},{"name":"Запеканка","selecteds":{"499":"Творожная запеканка","500":"Творожная запеканка в духовке","501":"Творожная запеканка в мультиварке","502":"Творожная запеканка с манкой","503":"Творожная запеканка с манкой в духовке","508":"Творожная запеканка как в садике","505":"Творожная запеканка без манки","510":"ПП творожная запеканка","511":"Творожная запеканка с бананом","4182":"Картофельная запеканка","4183":"Запеканка из макарон"}},{"name":"Десерты","selecteds":{"863":"Меренговый рулет","2164":"Имбирные пряники"}},{"name":"Кремы для торта","selecteds":{"2091":"Крем для торта Наполеон","1998":"Заварной крем для торта","2015":"Творожный крем для торта","1978":"Крем чиз для торта","2057":"Белковый крем для торта","2073":"Крем для украшения торта","2083":"Крем для выравнивания торта","2041":"Масляный крем для торта","2043":"Сливочный крем для торта","2064":"Шоколадный крем для торта","2028":"Сметанный крем для торта"}},{"name":"Хлеб","selecteds":{"2254":"Хлеб в хлебопечке","2261":"Белый хлеб в хлебопечке","2272":"Ржаной хлеб в хлебопечке"}},{"name":"Тесто","selecteds":{"2330":"Тесто для курника","2356":"Тесто для чебуреков","2670":"Тесто для пиццы"}}]}},{"block":{"name":"Вторые блюда","menu":[{"name":"Мясные блюда","selecteds":{"2104":"Бешбармак","741":"Ленивые голубцы","714":"Лазанья","2111":"Хашлама","2121":"Шулюм","2127":"Цыпленок табака","2169":"Гусь в духовке","2198":"Холодец","2340":"Курник","2482":"Утка в духовке","3089":"Солянка из капусты","3635":"Куриные котлеты"}},{"name":"Рыбные блюда","selecteds":{"1702":"Горбуша в духовке","2138":"Соленая горбуша","2133":"Соленая форель"}},{"name":"Каши","selecteds":{"2282":"Геркулесовая каша","2296":"Каша Дружба","2317":"Ячневая каша"}}]}},{"block":{"name":"Салаты","menu":[{"name":"Салаты с курицей","selecteds":{"2374":"Салат с курицей и ананасом","2414":"Салаты с курицей и грибами"}},{"name":"Крабовые салаты","selecteds":{"3224":"Салат с крабовыми палочками","3226":"Крабовый салат с кукурузой и яйцами","3229":"Крабовый салат с рисом и кукурузой","3228":"Крабовый салат с кукурузой, яйцом и огурцом"}},{"name":"Салаты с кальмарами","selecteds":{"2412":"Салаты с кальмарами","2872":"Салат с кальмарами и яйцом","2873":"Салат с кальмарами и огурцом"}}]}}]'
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
