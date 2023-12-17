<?php

namespace App\Http\Controllers;

use App\Models\MenuCategory;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Validation\Rule;

class MenuCategoryController extends Controller
{
    //
    public function all(){
        $data = MenuCategory::all();
        return Response()->json($data);
    }

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
            "categoryName" => ['required', 'min:3'],
        ]);

        $category = MenuCategory::updateOrCreate(
            ['id' => $request->id],
            ['categoryName' => $validated['categoryName']]);

        return Response()->json($category);
    }

    public function edit(Request $request){
        $category = MenuCategory::where('id', '=', $request->id)->first();

        return Response()->json($category);
    }

    public function destroy(Request $request){
        $category = MenuCategory::where('id', '=', $request->id)->delete();

        return Response()->json($category); 
    }
}
