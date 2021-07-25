<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dt = Carbon::now();
        $dateNow = $dt->toDateTimeString();
        DB::table('roles')->insert(array(
            array(
                'user_type' => 'Owner',
                'created_at' => $dateNow,
                'updated_at' => $dateNow
            ),
            array(
                'user_type' => 'Manager',
                'created_at' => $dateNow,
                'updated_at' => $dateNow
            ),
            array(
                'user_type' => 'User',
                'created_at' => $dateNow,
                'updated_at' => $dateNow
            ),
        ));
    }
}
