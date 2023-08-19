<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MetaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        $data = [
            [
                'key' => 'logo',
                'value' => 'image.jpg',
            ],
            [
                'key' => 'title',
                'value' => 'alzero title welcome',
            ],

            [
                'key' => 'description_header',
                'value' => 'Here Iam gonna share everything about my life. Books Iam reading, Games Iam Playing, Stories and Events',
            ],
            [
                'key' => 'ourskill_image',
                'value' => 'skill_image',
            ],

            [
                'key' => 'gallery',
                'value' => 'image.jpg',
            ],
  
        ];

        DB::table('meta')->insert($data);


    }

    }


