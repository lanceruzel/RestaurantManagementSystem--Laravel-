<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    //
    public function index(){
        $day = '';
        $total = 0;
        $result = null;
        $data = array();    

        for($i = 7; $i >= 0; $i--){
            if($i == 0){
                $date = now()->toDateString();

                $result = DB::table('bill')
                    ->select(DB::raw('SUM(total) as total'), DB::raw('DAYNAME(created_at) as day'))
                    ->where('paymentStatus' , '=', 'completed')
                    ->whereDate('created_at', $date)
                    ->groupBy(DB::raw('DAYNAME(created_at)'))
                    ->get();
            }else{
                $date = now()->subDays($i)->toDateString(); 

                $result = DB::table('bill')
                    ->select(DB::raw('SUM(total) as total'), DB::raw('DAYNAME(created_at) as day'))
                    ->where('paymentStatus' , '=', 'completed')
                    ->whereDate('created_at', '=', DB::raw("SUBDATE('" . $date . "', INTERVAL " . $i . " DAY)"))
                    ->groupBy(DB::raw('DAYNAME(created_at)'))
                    ->get();
            }   
  
            if (!empty($result) && isset($result[0]->day) && isset($result[0]->total)) {
                if ($i == 0) {
                    $day = "Today";
                } else {
                    $day = $result[0]->day;
                }

                $total = $result[0]->total;
            } else {
                $day = "No Data";
                $total = 0;
            }
            
            $newData = array("day" => $day, "total" => $total);
            array_push($data, $newData);
        }

        return view('index', ['data' => $data]);
    }

    public function analytics(){
        DB::statement("SET time_zone = '+08:00'");
        
        $month = Bill::whereRaw('MONTH(created_at) = MONTH(CURRENT_DATE())')
            ->where('paymentStatus' , '=', 'completed')
            ->whereRaw('YEAR(created_at) = YEAR(CURRENT_DATE())')
            ->sum('total');

        $today = Bill::whereRaw('DAYOFYEAR(created_at) = DAYOFYEAR(CURRENT_DATE())')
            ->where('paymentStatus' , '=', 'completed')
            ->sum('total');

        $week = Bill::whereRaw('YEAR(created_at) = YEAR(CURRENT_DATE())')
            ->where('paymentStatus' , '=', 'completed')
            ->whereRaw('WEEKOFYEAR(created_at) = WEEKOFYEAR(CURRENT_DATE())')
            ->sum('total');

        $annual = Bill::whereRaw('YEAR(created_at) = YEAR(CURRENT_DATE())')
            ->where('paymentStatus' , '=', 'completed')
            ->sum('total');

        return Response()->json(['today' => $today, 'month' => $month, 'week' => $week, 'annual' => $annual]); 
    }
}
