<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('settings')->insert([
            [
                'check_in_start' => '05:00:00',
                'check_in_end' => '08:15:00',
                'check_out_start' => '16:00:00',
                'check_out_end' => '20:30:00',
                'holiday_1' => '-',
                'holiday_2' => '-',
                'time_zone' => 'Asia/Jakarta',
                'bot_token' => 'your_bot_token_here',
                'ip_address' => '192.168.1.121',
            ],
        ]);
    }
}
