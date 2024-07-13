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
                'time_zone' => 'Asia/Jakarta',
                'bot_token' => '-',
                'ip_address' => '192.168.1.121',
            ],
        ]);
    }
}
