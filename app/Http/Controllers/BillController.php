<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class BillController extends Controller
{
    //
    public function incompleteBills(){
        //$bill = Bill::where('orderStatus', '<>', 'Completed')->where('paymentStatus', '<>', 'Completed')->get();
        $bill = DB::table('bill')
        ->select('*', 'tables.tableName', 'bill.id as id')
        ->leftJoin('tables', 'tables.id', '=', 'bill.assignedTable')
        ->get();

        return Response()->json($bill);
    }

    public function store(Request $request){
        $bill = Bill::create([
            'assignedAccount' => $request['accountID'],
            'assignedTable' => $request['tableID'],
            'total' => $request['total'],
        ]);

        return Response()->json($bill);
    }
}
