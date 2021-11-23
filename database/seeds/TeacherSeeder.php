<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TeacherSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker\Factory::create();

        foreach ((range(1, 25)) as $index) {
            $teacher = \App\Instructor::create([
                'years_of_experience' => 3,
                'teaching_level' => json_encode(['Primary']),
                'teaching_type' => json_encode(['Remote']),
                'latitude' => 25.388655,
                'longitude' => 51.416702,
                'about' => $faker->text(200),
                'is_completed' => true,
                'is_trusted' => true,
                'pricing' => $faker->randomNumber(),
                'created_at' => now(),
                'updated_at'=> now()
            ]);

            DB::table('users')->insert(
                [
                    'full_name' => $faker->name,
                    'contact_point' => $faker->unique()->email,
                    'encrypted_password' => bcrypt('password'),
                    'userable_id' => $index,
                    'userable_type' => 'App\Instructor' ,
                    'gender' => $index % 2 === 0 ? 'Male' : 'Female',
                    'created_at' => now(),
                    'updated_at'=> now()
                ]
            );
        }
    }
}
