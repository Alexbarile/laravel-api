<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

// richiamo MODEL TYPE
use App\Models\Type;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = ['FullStack', 'FrontEnd', 'BackEnd', 'Design'];

        foreach($types as $type){
            $newType = new Type();

            $newType->name = $type;
            $newType->slug = Str::slug($newType->name, '-');

            $newType->save();
        }
    }
}
