<?php

use Illuminate\Database\Seeder;

class SchedulesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $schedules_list = [
            '06:00 - 14:00' => 'A',
            '14:00 - 22:00' => 'B',
            '22:00 - 06:00' => 'C'
        ];

        foreach ($schedules_list as $schedule => $letter) {
            DB::table('schedules')->insert([
                'time_range' => $schedule,
                'letter' => $letter,
                'hours' => 8
            ]);
        }
    }
}
