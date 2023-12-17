<?php

namespace App\Http\Controllers;

use App\Models\MenuCategory;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Validation\Rule;

class MenuCategoryController extends Controller
{
    //
    public function index(){
        if(request()->ajax()){
            return datatables()->of(MenuCategory::all())
            ->addColumn('action', 'TableActions.table-action-addEdit') 
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }

        return view('index');
    }

    public function store(Request $request){
        $validated = $request->validate([
            "categoryName" => ['required', 'min:3', Rule::unique('menu_category', 'categoryName')],
        ]);

        $table = MenuCategory::updateOrCreate(
            ['id' => $request->id],
            ['categoryName' => $validated['categoryName']]);

        return Response()->json($table);
    }

    public function edit(Request $request){
        $where = array('id' => $request->id);
        $table = MenuCategory::where($where)->first();

        return Response()->json($table);
    }

    public function destroy(Request $request){
        $table = MenuCategory::where('id', '=', $request->id)->delete();

        return Response()->json($table); 
    }
}
