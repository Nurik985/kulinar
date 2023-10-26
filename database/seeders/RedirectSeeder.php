<?php

namespace Database\Seeders;

use App\Models\Redirect;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RedirectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $redirects = [
            [
                'old-url' => 'https://kulinarenok.ru/keksy/keks-klassicheskiy/',
                'new-url' => 'https://kulinarenok.ru/keksy/recepty-keksov/',
            ],
            [
                'old-url' => 'https://kulinarenok.ru/salaty/salat-cezar/',
                'new-url' => 'https://kulinarenok.ru/salaty/cezar/',
            ],
            [
                'old-url' => 'https://kulinarenok.ru/zelen/blyuda-iz-revenya/page=0/',
                'new-url' => 'https://kulinarenok.ru/zelen/blyuda-iz-revenya/',
            ],
            [
                'old-url' => 'https://kulinarenok.ru/keksy/recepty-keksov/page=0/',
                'new-url' => 'https://kulinarenok.ru/keksy/recepty-keksov/',
            ],
            [
                'old-url' => 'https://kulinarenok.ru/testo/testo-dlya-belyashey/page=0/',
                'new-url' => 'https://kulinarenok.ru/testo/testo-dlya-belyashey/',
            ],
            [
                'old-url' => 'https://kulinarenok.ru/mannik/recepty-mannika/page=0/',
                'new-url' => 'https://kulinarenok.ru/mannik/recepty-mannika/',
            ],
            [
                'old-url' => 'https://kulinarenok.ru/kabachki/kabachki-v-duhovke-bystro-i-vkusno/',
                'new-url' => 'https://kulinarenok.ru/kabachki/kabachki-v-duhovke/',
            ],
            [
                'old-url' => 'https://kulinarenok.ru/vypechka/kulichi-na-pashu-2020/',
                'new-url' => 'https://kulinarenok.ru/vypechka/kulichi-na-pashu-2021/',
            ],
            [
                'old-url' => 'https://kulinarenok.ru/zelen/shchavel-na-zimu-v-bankah/',
                'new-url' => 'https://kulinarenok.ru/zelen/shchavel-v-bankah-na-zimu/',
            ],
            [
                'old-url' => 'https://kulinarenok.ru/zelen/shchavel-na-zimu/',
                'new-url' => 'https://kulinarenok.ru/zelen/shchavel-zagotovki-na-zimu/',
            ],
            [
                'old-url' => 'https://kulinarenok.ru/vypechka/pashalnye-kulichi-na-smetane/',
                'new-url' => 'https://kulinarenok.ru/vypechka/kulichi-na-smetane-pashalnye/',
            ],
            [
                'old-url' => 'https://kulinarenok.ru/vypechka/apelsinovye-pashalnye-kulichi/',
                'new-url' => 'https://kulinarenok.ru/vypechka/apelsinovye-kulichi/',
            ],
            [
                'old-url' => 'https://kulinarenok.ru/zelen/shchavel-v-bankah-na-zimu/',
                'new-url' => 'https://kulinarenok.ru/zelen/shchavel-v-bankah/',
            ],
            [
                'old-url' => 'https://kulinarenok.ru/varene/varene-iz-sosnovyh-shishek-na-zimu/',
                'new-url' => 'https://kulinarenok.ru/varene/varene-iz-sosnovyh-shishek/',
            ],
            [
                'old-url' => 'https://kulinarenok.ru/vypechka/glazur-dlya-pashalnogo-kulicha/',
                'new-url' => 'https://kulinarenok.ru/vypechka/glazur-dlya-kulicha/',
            ],
            [
                'old-url' => 'https://kulinarenok.ru/varene/varene-iz-klubniki/',
                'new-url' => 'https://kulinarenok.ru/varene/varene-iz-klubniki-na-zimu/',
            ],
            [
                'old-url' => 'https://kulinarenok.ru/vypechka/tvorozhnaya-pasha/',
                'new-url' => 'https://kulinarenok.ru/vypechka/pasha-tvorozhnaya/',
            ],
            [
                'old-url' => 'https://kulinarenok.ru/kompoty/kompot-iz-abrikosov-v-1-litrovoy-banke/',
                'new-url' => 'https://kulinarenok.ru/kompoty/kompot-iz-abrikosov-na-1-litrovuyu-banku/',
            ],
            [
                'old-url' => 'https://kulinarenok.ru/kompoty/kompot-iz-irgi-v-3-h-litrovyh-bankah-na-zimu/',
                'new-url' => 'https://kulinarenok.ru/kompoty/kompot-iz-irgi-na-3-h-litrovuyu-banku-na-zimu/',
            ],
            [
                'old-url' => 'https://kulinarenok.ru/pomidory/pomidory-na-zimu/',
                'new-url' => 'https://kulinarenok.ru/pomidory/zagotovki-iz-pomidorov-na-zimu/',
            ],
            [
                'old-url' => 'https://kulinarenok.ru/arbuz/varene-iz-arbuznyh-korok-s-limonom/',
                'new-url' => 'https://kulinarenok.ru/varene/varene-iz-arbuznyh-korok-s-limonom/',
            ],
            [
                'old-url' => 'https://kulinarenok.ru/novyj-god/recepty-na-novyy-god/',
                'new-url' => 'https://kulinarenok.ru/prazdnichnyj-stol/recepty-na-novyy-god/',
            ],
            [
                'old-url' => 'https://kulinarenok.ru/sharlotka/sharlotka-bez-yablok/',
                'new-url' => 'https://kulinarenok.ru/pirogi/sharlotka-bez-yablok/',
            ],
            [
                'old-url' => 'https://kulinarenok.ru/keksy/recepty-keksov/',
                'new-url' => 'https://kulinarenok.ru/vypechka/keksy/',
            ],
            [
                'old-url' => 'https://kulinarenok.ru/vypechka/kulichi-na-pashu-2021/',
                'new-url' => 'https://kulinarenok.ru/vypechka/pashalnye-kulichi/',
            ],
            [
                'old-url' => 'https://kulinarenok.ru/vypechka/kulichi-na-pashu-2022/kulichi-na-pashu/',
                'new-url' => 'https://kulinarenok.ru/vypechka/kulichi-na-pashu/',
            ],
            [
                'old-url' => 'https://kulinarenok.ru/zagotovki-na-zimu/slivy-na-zimu/',
                'new-url' => 'https://kulinarenok.ru/zagotovki/slivy-na-zimu/',
            ],
            [
                'old-url' => 'https://kulinarenok.ru/zagotovki-na-zimu/kizil-na-zimu/',
                'new-url' => 'https://kulinarenok.ru/zagotovki/kizil-na-zimu/',
            ],
            [
                'old-url' => 'https://kulinarenok.ru/zagotovki-na-zimu/krasnaya-smorodina-na-zimu/',
                'new-url' => 'https://kulinarenok.ru/zagotovki/krasnaya-smorodina-na-zimu/',
            ],
            [
                'old-url' => 'https://kulinarenok.ru/zagotovki-na-zimu/pomidory-na-zimu/',
                'new-url' => 'https://kulinarenok.ru/zagotovki/pomidory-na-zimu/',
            ],
            [
                'old-url' => 'https://kulinarenok.ru/supy/solyanka-iz-svezhey-kapusty/solyanka-iz-svezhey-kapusty-so-svininoy/',
                'new-url' => 'https://kulinarenok.ru/supy/solyanka/solyanka-iz-svezhey-kapusty-so-svininoy/',
            ],
            [
                'old-url' => 'https://kulinarenok.ru/bliny/recepty-blinov/',
                'new-url' => 'https://kulinarenok.ru/vypechka/bliny/',
            ],
            [
                'old-url' => 'https://kulinarenok.ru/bliny-zavarnye-na-kefire/',
                'new-url' => 'https://kulinarenok.ru/bliny-na-1-litr-kefira-s-kipyatkom/',
            ],
            [
                'old-url' => 'https://kulinarenok.ru/bliny-zavarnye/',
                'new-url' => 'https://kulinarenok.ru/bliny-na-pol-litra-kefira-s-kipyatkom/',
            ],
            [
                'old-url' => 'https://kulinarenok.ru/bliny-s-dyrochkami-na-moloke-i-kipyatke/',
                'new-url' => 'https://kulinarenok.ru/bliny-na-1-litr-moloka-s-kipyatkom/',
            ],
            [
                'old-url' => 'https://kulinarenok.ru/bliny-na-kipyatke/',
                'new-url' => 'https://kulinarenok.ru/bliny-na-stakan-moloka-s-kipyatkom/',
            ],
            [
                'old-url' => 'https://kulinarenok.ru/harcho/harcho-iz-govyadiny-s-risom/',
                'new-url' => 'https://kulinarenok.ru/supy/harcho-iz-govyadiny-s-risom-klassicheskiy/',
            ],
            [
                'old-url' => 'https://kulinarenok.ru/pechenochnyy-tort-iz-svinoy-pecheni/',
                'new-url' => 'https://kulinarenok.ru/pechenochnyy-tort-iz-svinoy-pecheni-klassicheskiy-recept/',
            ],
            [
                'old-url' => 'https://kulinarenok.ru/svinina-zapechennaya-v-rukave-v-duhovke---5-receptov-s-foto-poshagovo/',
                'new-url' => 'https://kulinarenok.ru/svinina-zapechennaya-v-rukave-v-duhovke/',
            ],
            [
                'old-url' => 'https://kulinarenok.ru/chizkeyki/chizkeyki-v-domashnih-usloviyah/',
                'new-url' => 'https://kulinarenok.ru/deserty/chizkeyki/',
            ],
            [
                'old-url' => 'https://kulinarenok.ru/vypechka/tvorozhnaya-zapekanka/tvorozhnaya-zapekanka/',
                'new-url' => 'https://kulinarenok.ru/vypechka/tvorozhnaya-zapekanka/',
            ],
            [
                'old-url' => 'https://kulinarenok.ru/medovik/medovik-v-domashnih-usloviyah/',
                'new-url' => 'https://kulinarenok.ru/deserty/torty/medovik/',
            ],
            [
                'old-url' => 'https://kulinarenok.ru/deserty/medovik/medovik-so-smetanoy-klassicheskiy/',
                'new-url' => 'https://kulinarenok.ru/deserty/medovik/medovik-so-smetannym-kremom-klassicheskiy/',
            ],
            [
                'old-url' => 'https://kulinarenok.ru/medovik/medovik-so-smetanoy-klassicheskiy/',
                'new-url' => 'https://kulinarenok.ru/deserty/medovik/medovik-so-smetannym-kremom-klassicheskiy/',
            ],
            [
                'old-url' => 'https://kulinarenok.ru/hachapuri/hachapuri-v-domashnih-usloviyah/',
                'new-url' => 'https://kulinarenok.ru/vypechka/hachapuri/',
            ],
            [
                'old-url' => 'https://kulinarenok.ru/ogurtsy-zakatka-na-1-litrovuyu-banku-na-zimu/',
                'new-url' => 'https://kulinarenok.ru/zakatka-ogurcov-na-1-litrovuyu-banku-na-zimu-9-receptov-s-foto-poshagovo/',
            ],
            [
                'old-url' => 'https://kulinarenok.ru/retsept-hrenoviny-iz-pomidor-i-hrena/',
                'new-url' => 'https://kulinarenok.ru/hrenovina-iz-pomidorov-i-hrena-dlitelnogo-hraneniya---5-receptov-s-foto-poshagovo/',
            ],
            [
                'old-url' => 'https://kulinarenok.ru/mannik-na-kefire-s-varenem/',
                'new-url' => 'https://kulinarenok.ru/mannik-na-1-stakan-kefira-1-stakan-manki-1-stakan-sahara/',
            ],
            [
                'old-url' => 'https://kulinarenok.ru/mannik/recepty-mannika/',
                'new-url' => 'https://kulinarenok.ru/vypechka/mannik/',
            ],
            [
                'old-url' => 'https://kulinarenok.ru/lecho/lecho-na-zimu/',
                'new-url' => 'https://kulinarenok.ru/zagotovki/lecho/',
            ],
            [
                'old-url' => 'https://kulinarenok.ru/salo/kak-zasolit-salo-v-domashnih-usloviyah/',
                'new-url' => 'https://kulinarenok.ru/zakuski/salo/',
            ],
            [
                'old-url' => 'https://kulinarenok.ru/holodec/domashniy-holodec/',
                'new-url' => 'https://kulinarenok.ru/zakuski/holodec/',
            ],
            [
                'old-url' => 'https://kulinarenok.ru/grecheskiy-salat/klassicheskiy-grecheskiy-salat/',
                'new-url' => 'https://kulinarenok.ru/salaty/grecheskiy-salat/',
            ],
            [
                'old-url' => 'https://kulinarenok.ru/gorohovyj-sup/kak-svarit-gorohovyy-sup/',
                'new-url' => 'https://kulinarenok.ru/supy/gorohovyy-sup/',
            ],
            [
                'old-url' => 'https://kulinarenok.ru/kabachkovaya-ikra-na-zimu-s-pomidorami-i-morkovyu-i-lukom/',
                'new-url' => 'https://kulinarenok.ru/kabachkovaya-ikra-na-zimu-s-pomidorami-i-morkovyu-i-lukom---5-receptov-s-foto-poshagovo/',
            ],
            [
                'old-url' => 'https://kulinarenok.ru/vareniki-s-kartoshkoy-poshagovyy-retsept/',
                'new-url' => 'https://kulinarenok.ru/vtorye/vareniki/vareniki-s-kartoshkoy/',
            ],
            [
                'old-url' => 'https://kulinarenok.ru/salaty/recepty-na-novyy-god/salaty-s-kalmarami/',
                'new-url' => 'https://kulinarenok.ru/salaty/salaty-s-kalmarami/',
            ],
            [
                'old-url' => 'https://kulinarenok.ru/vypechka/kulichi-na-pashu/aleksandriyskoe-testo-dlya-kulichey/',
                'new-url' => 'https://kulinarenok.ru/vypechka/kulichi-na-pashu/aleksandriyskoe-testo/',
            ],
            [
                'old-url' => 'https://kulinarenok.ru/pashalny-kulich-na-suhih-drozhzhah/',
                'new-url' => 'https://kulinarenok.ru/pashalnyy-kulich-na-venskom-teste/',
            ],
            [
                'old-url' => 'https://kulinarenok.ru/vtorye/recepty-zhulena/',
                'new-url' => 'https://kulinarenok.ru/vtorye/zhulen/',
            ],
            [
                'old-url' => 'https://kulinarenok.ru/supy/okroshka-recepty/',
                'new-url' => 'https://kulinarenok.ru/supy/okroshka/',
            ],
            [
                'old-url' => 'https://kulinarenok.ru/zakuski/recepty-malosolnyh-ogurcov/',
                'new-url' => 'https://kulinarenok.ru/zakuski/malosolnye-ogurcy/',
            ],
            [
                'old-url' => 'https://kulinarenok.ru/zagotovki-na-zimu/kryzhovnik-na-zimu/',
                'new-url' => 'https://kulinarenok.ru/zagotovki/kryzhovnik-na-zimu/',
            ],
            [
                'old-url' => 'https://kulinarenok.ru/vypechka/kulichi-na-pashu/vkusnaya-tvorozhnaya-pasha/',
                'new-url' => 'https://kulinarenok.ru/vypechka/pasha-tvorozhnaya/samaya-vkusnaya-tvorozhnaya-pasha/',
            ],
            [
                'old-url' => 'https://kulinarenok.ru/vypechka/recepty-na-pashu-2022/',
                'new-url' => 'https://kulinarenok.ru/vypechka/blyuda-na-pashu/',
            ],
            [
                'old-url' => 'https://kulinarenok.ru/vypechka/tvorozhnaya-pasha-klassicheskaya/',
                'new-url' => 'https://kulinarenok.ru/vypechka/pasha-tvorozhnaya/klassicheskaya-tvorozhnaya-pasha/',
            ],
            [
                'old-url' => 'https://kulinarenok.ru/vypechka/klassicheskaya-tvorozhnaya-pasha/shokoladnaya-tvorozhnaya-pasha/',
                'new-url' => 'https://kulinarenok.ru/vypechka/pasha-tvorozhnaya/shokoladnaya-tvorozhnaya-pasha/',
            ],
            [
                'old-url' => 'https://kulinarenok.ru/vypechka/testo-dlya-pashalnyh-kulichey/',
                'new-url' => 'https://kulinarenok.ru/vypechka/kulichi-na-pashu/vkusnoe-testo-dlya-pashalnyh-kulichey/',
            ],
            [
                'old-url' => 'https://kulinarenok.ru/vypechka/kulichi-na-pashu/vkusnye-pashalnye-kulichi/',
                'new-url' => 'https://kulinarenok.ru/vypechka/kulichi-na-pashu/samye-vkusnye-pashalnye-kulichi/',
            ],
            [
                'old-url' => 'https://kulinarenok.ru/vypechka/kulichi-na-pashu/glazur-dlya-kulicha/',
                'new-url' => 'https://kulinarenok.ru/vypechka/kulichi-na-pashu/glazur-dlya-pashalnogo-kulicha/',
            ],
            [
                'old-url' => 'https://kulinarenok.ru/vypechka/kulichi-na-pashu/glazur-na-zhelatine-dlya-kulichey/',
                'new-url' => 'https://kulinarenok.ru/vypechka/kulichi-na-pashu/glazur-dlya-kulicha-na-zhelatine/',
            ],
            [
                'old-url' => 'https://kulinarenok.ru/vypechka/kulichi-na-pashu/glazur-iz-belkov-i-saharnoy-pudry-dlya-kulicha/',
                'new-url' => 'https://kulinarenok.ru/vypechka/kulichi-na-pashu/glazur-dlya-kulicha-iz-belkov-i-saharnoy-pudry/',
            ],
            [
                'old-url' => 'https://kulinarenok.ru/pirog-napoleon-s-kurinym-file-i-gribami/',
                'new-url' => 'https://kulinarenok.ru/zakusochnyy-tort-napoleon-s-kuricey-i-gribami/',
            ],
            [
                'old-url' => 'https://kulinarenok.ru/pyshnye-syrniki-iz-tvoroga-na-skovorode---klassicheskiy-recept/',
                'new-url' => 'https://kulinarenok.ru/pyshnye-syrniki-iz-tvoroga-na-skovorode/',
            ],
            [
                'old-url' => 'https://kulinarenok.ru/vypechka/kulichi-na-pashu/kulichi-na-pashu-2022/',
                'new-url' => 'https://kulinarenok.ru/vypechka/kulichi-na-pashu/kulichi-na-pashu-2023/',
            ],
            [
                'old-url' => 'https://kulinarenok.ru/kotlety-v-duhovke/',
                'new-url' => 'https://kulinarenok.ru/sochnye-kotlety-v-duhovke/',
            ],
            [
                'old-url' => 'https://kulinarenok.ru/makarony-po-flotski/makarony-po-flotski-recepty/',
                'new-url' => 'https://kulinarenok.ru/makarony-po-flotski-recepty/',
            ],
            [
                'old-url' => 'https://kulinarenok.ru/zakuski/malosolnye-ogurcy/malosolnye-ogurcy-za-2-chasa-v-pakete/',
                'new-url' => 'https://kulinarenok.ru/ogurtsy-malosolnye-v-pakete-s-chesnokom-i-ukropom-bystro/',
            ],
            [
                'old-url' => 'https://kulinarenok.ru/novogodnee-menyu-2022/',
                'new-url' => 'https://kulinarenok.ru/novogodnee-menyu-2024/',
            ],
            [
                'old-url' => 'https://kulinarenok.ru/utka-na-novyy-god-2022-v-duhovke/',
                'new-url' => 'https://kulinarenok.ru/utka-na-novyy-god-2024-v-duhovke/',
            ],
            [
                'old-url' => 'https://kulinarenok.ru/lenivye-golubcy-na-skovorode/',
                'new-url' => 'https://kulinarenok.ru/lenivye-golubtsy-na-skovorode/',
            ],
            [
                'old-url' => 'https://kulinarenok.ru/vtorye/utka-v-duhovke/utka-v-duhovke-na-novyy-god-2023/',
                'new-url' => 'https://kulinarenok.ru/vtorye/utka-v-duhovke/utka-v-duhovke-na-novyy-god-2024/',
            ],
            [
                'old-url' => 'https://kulinarenok.ru/sladkaya-vypechka/imbirnye-pryaniki-na-novyy-god-2023/',
                'new-url' => 'https://kulinarenok.ru/vypechka/imbirnye-pryaniki-na-novyy-god-2024/',
            ],
            [
                'old-url' => 'https://kulinarenok.ru/recepty-blyud-na-novyy-god-2024/',
                'new-url' => 'https://kulinarenok.ru/novogodnee-menyu-2024/',
            ],
        ];

        foreach ($redirects as $redirect) {
            Redirect::create($redirect);
        }
    }
}
