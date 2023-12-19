<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class OrderController extends Controller
{
    //
    public function store(Request $request){
        $orders = json_decode($request->orders, true);
        //print_r($trest);

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

    function array_push_assoc($array, $key, $value){
        $array[$key] = $value;
        return $array;
     }
}
