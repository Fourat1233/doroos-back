<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('subject_categories')->insert([
            [
                'name' => 'Literature',
                'ar_name' => 'ادب',
            ],
            [
                'name' => 'Language',
                'ar_name' => 'لغات',
            ],
            [
                'name' => 'Science',
                'ar_name' => 'علوم',
            ]
        ]);
        DB::table('subjects')->insert([
            [
                'name' => 'Arabic',
                'icon_url' => '1592690678.png',
                'ar_name' => 'العربية',
                'category_id' => 2,
                'created_at' => now(),
                'updated_at'=> now()
            ],[
                'name' => 'Mathematics',
                'ar_name' => 'رياضيات',
                'category_id' => 3,
                'icon_url' => '1592690006.png',
                'created_at' => now(),
                'updated_at'=> now()
            ],[
                'name' => 'Chemistry',
                'ar_name' => 'الكيمياء',
                'category_id' => 3,
                'icon_url' => '1592690696.png',
                'created_at' => now(),
                'updated_at'=> now()
            ],[
                'name' => 'IT science',
                'ar_name' => 'علوم الحاسوب',
                'category_id' => 3,
                'icon_url' => '1592690706.png',
                'created_at' => now(),
                'updated_at'=> now()
            ],[
                'name' => 'French',
                'ar_name' => 'الفرنسية',
                'category_id' => 2,
                'icon_url' => '1592690727.png',
                'created_at' => now(),
                'updated_at'=> now()
            ],[
                'name' => 'Design',
                'ar_name' => 'التصميم',
                'category_id' => 3,
                'icon_url' => '1592690836.png',
                'created_at' => now(),
                'updated_at'=> now()
            ],[
                'name' => 'Spanish',
                'ar_name' => 'الاسبانية',
                'category_id' => 2,
                'icon_url' => '1592691035.png',
                'created_at' => now(),
                'updated_at'=> now()
            ],[
                'name' => 'Philosophy',
                'ar_name' => 'الفلسفة',
                'category_id' => 1,
                'icon_url' => '1592691080.png',
                'created_at' => now(),
                'updated_at'=> now()
            ],[
                'name' => 'History',
                'ar_name' => 'التاريخ',
                'category_id' => 1,
                'icon_url' => '1592691097.png',
                'created_at' => now(),
                'updated_at'=> now()
            ],[
                'name' => 'English',
                'ar_name' => 'الانجلزية',
                'category_id' => 2,
                'icon_url' => '1592691226.png',
                'created_at' => now(),
                'updated_at'=> now()
            ]
        ]);
    }
}
