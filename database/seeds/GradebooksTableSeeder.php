<?php

use Illuminate\Database\Seeder;

class GradebooksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //pronaci nacin kako popuniti professor_id u gradebooks!
        factory(App\Professor::class, 30)->make()
        ->each(function (App\Professor $professor) {
            $professor->gradebooks()->saveMany(factory(App\Gradebook::class, 1)->create());
        });
    }
}
