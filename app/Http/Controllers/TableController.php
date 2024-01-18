<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\Table;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Validation\Rule;

class TableController extends Controller
{
    public function index(){
        if(request()->ajax()){
            return datatables()->of(Table::all())
            ->addColumn('action', 'TableActions.table-action-AddEdit')
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }

        return view('index');
    }

    public function store(Request $request){
        $validated = $request->validate([
            "tableName" => ['required', 'min:3', 'unique:tables'],
            "tableCapacity" => ['required', 'min:1']
        ]);

        $table = Table::updateOrCreate(
            ['id' => $request->id],
            ['tableName' => $validated['tableName'],
            'tableCapacity' => $validated['tableCapacity'],
            'status' => $request->status,
            'availability' => $request->availability]);

        return Response()->json($table);
    }

    public function edit(Request $request){
        $where = array('id' => $request->id);
        $table = Table::where($where)->first();

        return Response()->json($table);
    }

    public function destroy(Request $request){
        $table = Table::where('id', '=', $request->id)->delete();

        return Response()->json($table); 
    }

    public function updateTableAvailability(Request $request){
        $table = Table::where('id', '=', $request->id)->update(['availability' => $request->availability]);
        return Response()->json($table);
    }
}
