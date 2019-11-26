<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->truncate();
        factory(App\Models\User::class, 50)->create();
    }
}

