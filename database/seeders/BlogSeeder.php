<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Administrator;
use Faker\Factory as Faker;

class BlogSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        DB::table('blogs')->truncate();

        foreach (range(1, 30) as $index) {
            DB::table('blogs')->insert([
                'heading' => $faker->sentence(6), // Random heading
                'title' => $faker->sentence(10), // Random title
                'admin_id' => Administrator::inRandomOrder()->value('id'),
                'content' => $this->generateContentWithImages($faker),
            ]);
        }
    }

    private function generateContentWithImages($faker)
    {
        $content = '';

        for ($i = 0; $i < 15; $i++) { // 5 paragraphs
            $content .= '<p>' . $faker->paragraph(20) . '</p>';
        }

        return $content;
    }
}
