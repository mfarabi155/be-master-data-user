<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Menu;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Menu::create([
            'menu_name' => 'Dashboard',
            'menu_url' => '/dashboard',
            'menu_status' => '1',
            'menu_icon' => 'dashboard_icon',
            'menu_order' => 1,
            'parent_menu_id' => null,
        ]);

        Menu::create([
            'menu_name' => 'Master Pengguna',
            'menu_url' => '/master-pengguna',
            'menu_status' => '1',
            'menu_icon' => 'user_icon',
            'menu_order' => 2,
            'parent_menu_id' => null,
        ]);

        Menu::create([
            'menu_name' => 'Log Out',
            'menu_url' => '/logout',
            'menu_status' => '1',
            'menu_icon' => 'logout_icon', 
            'menu_order' => 3,
            'parent_menu_id' => null,
        ]);
    }
}

