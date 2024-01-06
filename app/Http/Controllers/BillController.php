<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\Table;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class BillController extends Controller
{
    //
    public function index(){
        if(request()->ajax()){
            return datatables()->of(
                DB::table('bill')
                ->select('*', 'tables.tableName' , DB::raw("CONCAT(employeeinformation.firstName,' ',employeeinformation.lastName) as fullname"), 'bill.id as id', DB::raw("CONCAT('₱', bill.total) as totalFormatted"))
                ->leftJoin('employeeinformation', 'employeeinformation.accountID', '=', 'bill.assignedAccount')
                ->leftJoin('tables', 'tables.id', '=', 'bill.assignedTable')
                ->get())
            ->addColumn('action', 'TableActions.table-action-ViewPay') 
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }

        return view('index');
    }

    public function ordersViewBill(Request $request){
        $data = array();

        $bill = DB::table('bill')
        ->select('*', 'tables.tableName', 'bill.id as id')
        ->leftJoin('tables', 'tables.id', '=', 'bill.assignedTable')
        ->where('orderStatus', '<>', 'Completed')
        ->get();
        
        foreach($bill as $item){
            $orders = DB::table('orders')
            ->select('*', 'menu.menuName', 'bill.id', 'orders.id as id')
            ->leftJoin('menu', 'menu.id', '=', 'orders.menuID')
            ->leftJoin('bill', 'bill.id', '=', 'orders.billID')
            ->where('orders.billID', '=', $item->id)
            ->get();

            $asd = array(
                'id' => $item->id,
                'orderStatus' => $item->orderStatus,
                'tableName' => $item->tableName,
                'orders' => $orders
            );

            array_push($data, $asd);
        }

        //print_r($data);
        return Response()->json($data);
    }

    public function incompleteBills(){
        $bill = DB::table('bill')
        ->select('*', 'tables.tableName', 'bill.id as id')
        ->leftJoin('tables', 'tables.id', '=', 'bill.assignedTable')
        ->where('orderStatus', '<>', 'Completed')
        ->orWhere('paymentStatus', '<>', 'Completed')
        ->get();

        return Response()->json($bill);
    }

    public function store(Request $request){
        $bill = Bill::create([
            'assignedAccount' => $request['accountID'],
            'assignedTable' => $request['tableID'],
            'total' => $request['total'],
            'created_at' => now()
        ]);

        return Response()->json($bill);
    }

    public function updatePayment(Request $request){
        $bill = Bill::where('id', '=', $request->id)->update(['paymentStatus' => $request->paymentStatus]);

        $this->checkTableAvailability($request->id);

        return Response()->json($bill);
    }

    public function updateOrder(Request $request){
        $bill = Bill::where('id', '=', $request->id)->update(['orderStatus' => $request->orderStatus]);

        $this->checkTableAvailability($request->id);

        return Response()->json($bill);
    }

    public function checkTableAvailability($id){
        $bill = Bill::where('id', '=', $id)->first();

        if($bill->orderStatus === 'Completed' && $bill->paymentStatus === 'Completed'){
            Table::where('id', '=', $bill->assignedTable)->update(['availability' => 'Available']);
        }
    }
}
