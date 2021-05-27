<?php

use App\Organizer;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $collection = Organizer::all();
        foreach ($collection as $record){
            if (strcmp("demo1", $record["slug"]) == 0){
                $record["password_hash"] = bcrypt("demopass1");
            } else {
                $record["password_hash"] = bcrypt("demopass2");
            }

            $record->update();
        }
    }
}
