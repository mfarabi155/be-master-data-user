<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $table = 'menus';

    protected $fillable = [
        'menu_name', 
        'menu_url', 
        'menu_status', 
        'menu_icon', 
        'menu_order', 
        'parent_menu_id'
    ];

    public function parent()
    {
        return $this->belongsTo(Menu::class, 'parent_menu_id');
    }

    public function children()
    {
        return $this->hasMany(Menu::class, 'parent_menu_id');
    }
}

