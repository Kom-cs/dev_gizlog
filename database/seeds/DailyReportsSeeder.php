<?php

use Illuminate\Database\Seeder;

class DailyReportsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('daily_reports')->truncate();
        factory(App\Models\DailyReport::class, 50)->create();
    }
}
