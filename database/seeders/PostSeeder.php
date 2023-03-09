<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
// MODEL
use App\Models\Post;
// FAKER
use Faker\Generator as Faker;
// STR
use Illuminate\Support\Str;


class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for($i=0; $i<10; $i++){
            $newPost = new Post();
            $newPost->title = $faker->sentence(3);
            $newPost->content = $faker->text(300);
            $newPost->slug = Str::slug($newPost->title, '-');
            $newPost->cover_image = $faker->imageUrl(500, 500, 'Posts', true, 'dogs', true, 'jpg');

            $newPost->save();
        }
    }
}
