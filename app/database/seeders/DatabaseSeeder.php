<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(UserSeeder::class);
    }
}

class UserSeeder extends Seeder {
    public function run() {
        DB::table('users')->insert(
            [
                "name"=>"Phuong",
                "email"=>"hanhphuong@gmail.com",
                "password"=>bcrypt('password')
            ]
        );
    }
}
