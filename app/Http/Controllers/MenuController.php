<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::orderBy('menu_order')->get();
        return response()->json($menus);
    }

    public function store(Request $request)
    {
        $request->validate([
            'menu_name' => 'required|string|max:255',
            'menu_url' => 'required|url',
            'menu_status' => 'required|string|max:50',
            'menu_icon' => 'required|string|max:255',
            'menu_order' => 'required|integer',
            'parent_menu_id' => 'nullable|integer|exists:menus,id',
        ]);

        $menu = Menu::create([
            'menu_name' => $request->menu_name,
            'menu_url' => $request->menu_url,
            'menu_status' => $request->menu_status,
            'menu_icon' => $request->menu_icon,
            'menu_order' => $request->menu_order,
            'parent_menu_id' => $request->parent_menu_id,
        ]);

        return response()->json($menu, 201);
    }

    public function update(Request $request, $id)
    {
        $menu = Menu::findOrFail($id);

        $request->validate([
            'menu_name' => 'required|string|max:255',
            'menu_url' => 'required|url',
            'menu_status' => 'required|string|max:50',
            'menu_icon' => 'required|string|max:255',
            'menu_order' => 'required|integer',
            'parent_menu_id' => 'nullable|integer|exists:menus,id',
        ]);

        $menu->update([
            'menu_name' => $request->menu_name,
            'menu_url' => $request->menu_url,
            'menu_status' => $request->menu_status,
            'menu_icon' => $request->menu_icon,
            'menu_order' => $request->menu_order,
            'parent_menu_id' => $request->parent_menu_id,
        ]);

        return response()->json($menu);
    }

    public function destroy($id)
    {
        $menu = Menu::findOrFail($id);

        $menu->delete();

        return response()->json(['message' => 'Menu deleted successfully']);
    }
}

