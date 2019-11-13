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
        DB::table('daily_reports')->insert([
            [
                'user_id' => 1,
                'title' => 'Simple is the Best',
                'content' => 'Describe it',
                'reporting_time' => Carbon::create(2019, 10, 30),
                'created_at' => Carbon::create(2019, 10, 30),
                'updated_at' => Carbon::create(2019, 10, 30),
            ]
        ]);
        DB::table('daily_reports')->insert([
            [
                'user_id' => 2,
                'title' => 'タイトルはシンプルに',
                'content' => '日報は詳細に',
                'reporting_time' => Carbon::create(2019, 6, 30),
                'created_at' => Carbon::create(2019, 6, 30),
                'updated_at' => Carbon::create(2019, 6, 30),
            ]
        ]);
    }
}
