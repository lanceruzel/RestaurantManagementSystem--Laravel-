<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class MenuController extends Controller
{
    //
    public function index(){
        if(request()->ajax()){
            return datatables()->of(DB::table('menu'))
            ->addColumn('action', 'TableActions.table-action-addEdit') 
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }

        return view('index');
    }

    public function store(Request $request){
        $validated = $request->validate([
            "menuName" => ['required', 'min:3'],
            "menuPrice" => ['required'],
            "menuCategory" => ['required'],
        ]);
        
        $menu = Menu::updateOrCreate(
            ['id' => $request->id],
            ['categoryID' => $validated['menuCategory'],
            'menuName' => $validated['menuName'],
            'menuPrice' => $request['menuPrice'],
            'availability' => $request->availability]);

        return Response()->json($menu);
    }

    public function edit(Request $request){
        $menu = Menu::where('id', '=', $request->id)->first();

        return Response()->json($menu);
    }

    public function destroy(Request $request){
        $menu = Menu::where('id', '=', $request->id)->delete();

        return Response()->json($menu); 
    }
}
