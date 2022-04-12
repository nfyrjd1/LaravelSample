<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BlogCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [];

        $name = 'Без категории';
        $categories[] = [
            'title' => $name,
            'slug' => str_slug($name),
            'parent_id' => 0,
        ];

        for ($i = 1; $i <= 10; $i++) {
            $name = "Категория #$i";
            $parent = $i > 4 ? rand(1, 4) : 1;
            $categories[] = [
                'title' => $name,
                'slug' => str_slug($name),
                'parent_id' => $parent,
            ];
        }

        DB::table('blog_categories')->insert($categories);
    }
}
