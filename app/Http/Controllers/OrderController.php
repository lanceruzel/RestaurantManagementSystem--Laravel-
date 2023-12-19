<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    //
    public function store(Request $request){
        $orders = json_decode($request->orders, true);

        $data = [];

        foreach($orders as $order){
           $data[] = [
                'billID' => $request->billID,
                'menuID' => $order['id'],
                'price' => $order['menuPrice'],
                'quantity' => $order['quantity'],
                'total' => $order['total']
            ];
        }

        $orderEntry = Order::insert($data);
        return Response()->json($orderEntry);
    }

    public function viewOrders(Request $request){
        //$orders = Order::where('billID', '=', $request->id)->get();

        $orders = DB::table('orders')
        ->select('*', 'menu.menuName', 'bill.id', 'orders.id as id')
        ->leftJoin('menu', 'menu.id', '=', 'orders.menuID')
        ->leftJoin('bill', 'bill.id', '=', 'orders.billID')
        ->where('orders.billID', '=', $request->id)
        ->get();

        return Response()->json($orders);
    }

    public function updateQuantity(Request $request){
        $order = Order::where('id', '=', $request->id)->update(['quantity' => $request->quantity]);
        return Response()->json($order);
    }

    public function destroy(Request $request){
        $order = Order::where('id', '=', $request->id)->delete();
        return Response()->json($order);
    }
}
