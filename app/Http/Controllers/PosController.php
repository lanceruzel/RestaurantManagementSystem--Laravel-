<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\MenuCategory;
use App\Models\Table;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class PosController extends Controller
{
    //

    public function index(){
        $category = MenuCategory::all();
        $menu = Menu::all();
        return view('index', ['categoryList' => $category, 'menuList' => $menu]);
    }

    public function getTable(){
        $table = Table::where('status', '=', 'Active')->get();

        return Response()->json($table);
    }
}
