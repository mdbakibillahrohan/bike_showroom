<?php

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
        //php artisan make:seeder UserSeeder   make seeder
        //php artisan migrate:fresh --seed
        //php artisan db:seed --class=SubmenuSeeder
        $this->call([
            UserSeeder::class,
            RoleSeeder::class,
            SubmenuSeeder::class,
           // WarrentySeeder::class,
        ]);
    }
}
