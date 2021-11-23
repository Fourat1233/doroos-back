<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LocationSeeder extends Seeder
{
    public function run()
    {
        DB::table('locations')->insert([
            [
                'address' => 'Al Khartiyat',
                'lat' => '25.388655',
                'lng' => '51.416702'
            ],
            [
                'address' => 'Al Ebb',
                'lat' => '25.391304',
                'lng' => '51.4405007'
            ],
            [
                'address' => 'Al Kheesa',
                'lat' => '25.4030007',
                'lng' => '51.4293193'
            ],
            [
                'address' => 'Al Khor',
                'lat' => '25.6581513',
                'lng' => '51.4674705'
            ],
            [
                'address' => 'Al Dhakhira',
                'lat' => '25.729704',
                'lng' => '51.531372'
            ],
            [
                'address' => 'Al Thakhira',
                'lat' => '25.7357497',
                'lng' => '51.5224607'
            ],
            [
                'address' => 'Simaisma',
                'lat' => '25.5771298',
                'lng' => '51.4750242'
            ],
            [
                'address' => 'Al Sakhama',
                'lat' => '25.4754318',
                'lng' => '51.3979482'
            ],
            [
                'address' => 'Al Shahaniya',
                'lat' => '25.3880343',
                'lng' => '51.16363'
            ],
            [
                'address' => 'Doha',
                'lat' => '25.2839926',
                'lng' => '51.4419569'
            ],
            [
                'address' => 'Abu Hamour',
                'lat' => '25.2385603',
                'lng' => '51.4731573'
            ],
            [
                'address' => 'Ain Khaled',
                'lat' => '25.2307187',
                'lng' => '51.4415501'
            ],
            [
                'address' => 'Al Aziziya',
                'lat' => '25.2433108',
                'lng' => '51.4386402'
            ],
            [
                'address' => 'Al Bidda',
                'lat' => '25.2931876',
                'lng' => '51.5175856'
            ],
            [
                'address' => 'Al Dafna',
                'lat' => '25.3089016',
                'lng' => '51.5146675'
            ],
            [
                'address' => 'Al Doha Al Jadeeda',
                'lat' => '25.2773446',
                'lng' => '51.5315298'
            ],
            [
                'address' => 'Al Duhail',
                'lat' => '25.3451625',
                'lng' => '51.4594881'
            ],
            [
                'address' => 'Al Gharrafa',
                'lat' => '25.3302942',
                'lng' => '51.4367565'
            ],
            [
                'address' => 'Al Hilal',
                'lat' => '25.2612556',
                'lng' => '51.5319615'
            ],
            [
                'address' => 'Al Jasra',
                'lat' => '25.2886437',
                'lng' => '51.5302479'
            ],
            [
                'address' => 'Al Jebailat',
                'lat' => '25.3207837',
                'lng' => '51.5001913'
            ],
            [
                'address' => 'Al Khulaifat',
                'lat' => '25.2834484',
                'lng' => '51.5569312'
            ],
            [
                'address' => 'Al Khuwair',
                'lat' => '25.3146701',
                'lng' => '51.5068821'
            ],
            [
                'address' => 'Al Luqta',
                'lat' => '25.3081439',
                'lng' => '51.4527726'
            ],
            [
                'address' => 'Old Al Rayyan',
                'lat' => '25.303326',
                'lng' => '51.4423004'
            ],
            [
                'address' => 'Al Maamoura',
                'lat' => '25.2453922',
                'lng' => '51.4860044'
            ],
            [
                'address' => 'Al Mansoura / Fereej Bin Dirham',
                'lat' => '25.2688726',
                'lng' => '51.5246617'
            ],
            [
                'address' => 'Al Markhiya',
                'lat' => '25.3340152',
                'lng' => '51.4837887'
            ],
            [
                'address' => 'Al Mesaimeer',
                'lat' => '25.2021781',
                'lng' => '51.4806889'
            ],
            [
                'address' => 'Al Messila',
                'lat' => '25.3005703',
                'lng' => '51.4764606'
            ],
            [
                'address' => 'Al Murqab',
                'lat' => '25.2811103',
                'lng' => '51.5262451'
            ],
            [
                'address' => 'Al Muntazah',
                'lat' => '25.2708691',
                'lng' => '51.5150424'
            ],
            [
                'address' => 'Al Najada',
                'lat' => '25.2829049',
                'lng' => '51.5309456'
            ],
            [
                'address' => 'Al Nasr',
                'lat' => '25.2688546',
                'lng' => '51.4924775'
            ],
            [
                'address' => 'Al Qassar',
                'lat' => '25.3512757',
                'lng' => '51.5177129'
            ],
            [
                'address' => 'Al Qutaifiya',
                'lat' => '25.2839926',
                'lng' => '51.4419569'
            ],
            [
                'address' => 'Al Rumaila',
                'lat' => '25.2964602',
                'lng' => '51.5141984'
            ],
            [
                'address' => 'Al Sadd',
                'lat' => '25.2837918',
                'lng' => '51.4832209'
            ],
            [
                'address' => 'Al Tarfa',
                'lat' => '25.3756047',
                'lng' => '51.4799315'
            ],
            [
                'address' => 'Jelaiah',
                'lat' => '25.3532858',
                'lng' => '51.4849847'
            ],
            [
                'address' => 'Al Thumama',
                'lat' => '25.230536',
                'lng' => '51.5332281'
            ],
            [
                'address' => 'Al Waab',
                'lat' => '25.2569501',
                'lng' => '51.4610072'
            ],
            [
                'address' => 'Al Sailiya',
                'lat' => '25.2170983',
                'lng' => '51.3729799'
            ],
            [
                'address' => 'Aspire Zone',
                'lat' => '25.2637146',
                'lng' => '51.4387125'
            ],
            [
                'address' => 'Bani Hajer',
                'lat' => '25.3159614',
                'lng' => '51.3971542'
            ],
            [
                'address' => 'Barwa City',
                'lat' => '25.1956602',
                'lng' => '51.5001404'
            ],
            [
                'address' => 'Barwa Village',
                'lat' => '25.2043692',
                'lng' => '51.5725796'
            ],
            [
                'address' => 'Corniche',
                'lat' => '25.3124006',
                'lng' => '51.5196045'
            ],
            [
                'address' => 'Doha International Airport',
                'lat' => '25.264748',
                'lng' => '51.5573681'
            ],
            [
                'address' => 'Doha Port',
                'lat' => '25.2998049',
                'lng' => '51.546054'
            ],
            [
                'address' => 'Education City',
                'lat' => '25.3140684',
                'lng' => '51.4394023'
            ],
            [
                'address' => 'Fareej Al Ali',
                'lat' => '25.2464496',
                'lng' => '51.5065827'
            ],
            [
                'address' => 'Fereej Abdel Aziz',
                'lat' => '25.2783688',
                'lng' => '51.5214856'
            ],
            [
                'address' => 'Fereej Al Ameer',
                'lat' => '25.2869911',
                'lng' => '51.4706254'
            ],
            [
                'address' => 'Muraikh',
                'lat' => '25.2861477',
                'lng' => '51.4353703'
            ],
            [
                'address' => 'Fereej Al Murra',
                'lat' => '25.2320312',
                'lng' => '51.4279965'
            ],
            [
                'address' => 'Fereej Al Soudan',
                'lat' => '25.2683483',
                'lng' => '51.4760756'
            ],
            [
                'address' => 'Fereej Bin Mahmoud',
                'lat' => '25.2815594',
                'lng' => '51.5079869'
            ],
            [
                'address' => 'Fereej Bin Omran',
                'lat' => '25.304621',
                'lng' => '51.4910442'
            ],
            [
                'address' => 'Fereej Kulaib',
                'lat' => '25.3143894',
                'lng' => '51.487269'
            ],
            [
                'address' => 'Industrial Area',
                'lat' => '25.1814985',
                'lng' => '51.3920683'
            ],
            [
                'address' => 'Katara Cultural Village',
                'lat' => '25.361015',
                'lng' => '51.5223588'
            ],
            [
                'address' => 'Luaib',
                'lat' => '25.2862318',
                'lng' => '51.453309'
            ],
            [
                'address' => 'Lusail',
                'lat' => '25.4174134',
                'lng' => '51.4802594'
            ],
            [
                'address' => 'Madinat Khalifa North',
                'lat' => '25.3278937',
                'lng' => '51.4710893'
            ],
            [
                'address' => 'Dahl Al Hamam',
                'lat' => '25.3280216',
                'lng' => '51.4712026'
            ],
            [
                'address' => 'Madinat Khalifa South',
                'lat' => '25.3148243',
                'lng' => '51.4748103'
            ],
            [
                'address' => 'Mehairja',
                'lat' => '25.2698848',
                'lng' => '51.4508843'
            ],
            [
                'address' => 'Muither',
                'lat' => '25.2580444',
                'lng' => '51.3892792'
            ],
            [
                'address' => 'Mushaireb',
                'lat' => '25.2842928',
                'lng' => '51.5192651'
            ],
            [
                'address' => 'Najma',
                'lat' => '25.2694259',
                'lng' => '51.5373155'
            ],
            [
                'address' => 'New Al Ghanim',
                'lat' => '25.2358442',
                'lng' => '51.4351672'
            ],
            [
                'address' => 'New Al Hitmi',
                'lat' => '25.2973489',
                'lng' => '51.4899909'
            ],
            [
                'address' => 'New Al Rayyan',
                'lat' => '25.2522564',
                'lng' => '51.3324586'
            ],
            [
                'address' => 'Al Wajba',
                'lat' => '25.2922328',
                'lng' => '51.3607406'
            ],
            [
                'address' => 'New Industrial Area',
                'lat' => '25.1928182',
                'lng' => '51.3423895'
            ],
            [
                'address' => 'New salata',
                'lat' => '25.2637454',
                'lng' => '51.5146212'
            ],
            [
                'address' => 'Al Asiri',
                'lat' => '25.2635592',
                'lng' => '51.4969783'
            ],
            [
                'address' => 'Nuaija',
                'lat' => '25.2457832',
                'lng' => '51.5306806'
            ],
            [
                'address' => 'Old Airport',
                'lat' => '25.2513366',
                'lng' => '51.5437651'
            ],
            [
                'address' => 'Old Al Ghanim',
                'lat' => '25.2794298',
                'lng' => '51.5378467'
            ],
            [
                'address' => 'Old Al Hitmi',
                'lat' => '25.2847297',
                'lng' => '51.5415714'
            ],
            [
                'address' => 'Old Salata',
                'lat' => '25.2794296',
                'lng' => '51.5312806'
            ],
            [
                'address' => 'Onaiza',
                'lat' => '25.3429208',
                'lng' => '51.5049589'
            ],
            [
                'address' => 'Qatar National Convention Center',
                'lat' => '25.3220815',
                'lng' => '51.4352175'
            ],
            [
                'address' => 'Rawdat Al Khail',
                'lat' => '25.2699764',
                'lng' => '51.5119795'
            ],
            [
                'address' => 'Souq Waqif',
                'lat' => '25.2864631',
                'lng' => '51.5203354'
            ],
            [
                'address' => 'The Pearl Qatar',
                'lat' => '25.3686103',
                'lng' => '51.5428282'
            ],
            [
                'address' => 'Umm Al Amad',
                'lat' => '25.4898842',
                'lng' => '51.388194'
            ],
            [
                'address' => 'Umm Ghwailina',
                'lat' => '25.2759593',
                'lng' => '51.5416457'
            ],
            [
                'address' => 'Umm Lekhba',
                'lat' => '25.3451625',
                'lng' => '51.4594881'
            ],
            [
                'address' => 'Umm Salal Ali',
                'lat' => '25.2854473',
                'lng' => '51.5288511'
            ],
            [
                'address' => 'Umsalal Mohammed',
                'lat' => '25.3930681',
                'lng' => '51.3871594'
            ],
            [
                'address' => 'Wadi Al Sail',
                'lat' => '25.3092253',
                'lng' => '51.4967167'
            ],
            [
                'address' => 'West Bay',
                'lat' => '25.3199369',
                'lng' => '51.5193986'
            ],
            [
                'address' => 'Dukhan',
                'lat' => '25.4305209',
                'lng' => '50.764818'
            ],
            [
                'address' => 'Mesaeidd',
                'lat' => '24.9533852',
                'lng' => '51.5292526'
            ],
            [
                'address' => 'Al Wakrah',
                'lat' => '25.1628337',
                'lng' => '51.5824995'
            ],
            [
                'address' => 'Al Wukair',
                'lat' => '25.1495597',
                'lng' => '51.5114956'
            ]
        ]);
    }
}
