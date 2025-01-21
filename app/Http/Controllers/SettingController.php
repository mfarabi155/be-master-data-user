<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::all();
        return response()->json($settings);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:settings,name',
            'value' => 'required|string',
        ]);

        $setting = Setting::create([
            'name' => $request->name,
            'value' => $request->value,
        ]);

        return response()->json($setting, 201);
    }

    public function show($name)
    {
        $setting = Setting::where('name', $name)->firstOrFail();
        return response()->json($setting);
    }

    public function update(Request $request, $id)
    {
        $setting = Setting::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255|unique:settings,name,' . $setting->id,
            'value' => 'required|string',
        ]);

        $setting->update([
            'name' => $request->name,
            'value' => $request->value,
        ]);

        return response()->json($setting);
    }

    public function destroy($id)
    {
        $setting = Setting::findOrFail($id);
        $setting->delete();

        return response()->json(['message' => 'Setting deleted successfully.']);
    }
}
