<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

// MODEL
use App\Models\Technology;

class TechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $technologies = ['HTML', 'CSS', 'JAVASCRIPT', 'JAVA', 'VUEJS', 'PHP', 'LARAVEL'];

        foreach($technologies as $technology){
            $newTechnology = new Technology();
            $newTechnology->name = $technology;
            $newTechnology->slug = Technology::generateSlug($newTechnology->name);

            $newTechnology->save();

        }
    }
}
