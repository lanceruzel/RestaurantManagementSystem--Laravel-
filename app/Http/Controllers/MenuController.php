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
            return datatables()->of(
                DB::table('menu')
                ->select('*', 'menu_category.categoryName', 'menu.id as id')
                ->leftJoin('menu_category', 'menu_category.id', '=', 'menu.categoryID')
                ->get())
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

        $checkMenuName = Menu::where('menuName', $validated['menuName'])
                            ->where('id', '<>', $request->id)
                            ->first();

        if ($checkMenuName) {
            return response()->json(['errors' => ['menuName' => ['Menu name is already taken.']]], 422);
        }

        $menu = Menu::updateOrCreate(
            ['id' => $request->id],
            [
                'categoryID' => $validated['menuCategory'],
                'menuPrice' => $request['menuPrice'],
                'availability' => $request->availability,
                'menuName' => $validated['menuName'],
            ]
        );

        if ($request->id && $menu->wasChanged('menuName')) {
            $menu->update(['menuName' => $validated['menuName']]);
        }

        return response()->json($menu);
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
