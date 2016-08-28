<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Setting;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Clears database
        DB::table('users')->delete();
        DB::table('settings')->delete();

        //Seeds database
        factory(User::class,"admin", 1)->create();
        factory(User::class, 10)->create();
        factory(Setting::class, 1)->create();
    }
}
