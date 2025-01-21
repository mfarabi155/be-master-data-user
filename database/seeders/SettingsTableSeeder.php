<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingsTableSeeder extends Seeder
{
    public function run()
    {
        Setting::create([
            'name' => 'icon_dashboard',
            'value' => 'dashboard-icon.png',
        ]);
    }
}
