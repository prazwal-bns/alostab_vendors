<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use DateTime;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function ViewReport(){
        return view('backend.report.view_report');
    }
    // END FUNCTION
    
    public function SearchByDate(Request $request){
        $date = new DateTime($request->date);
        $formatDate = $date->format('d F Y');
        
        $orders = Order::where('order_date',$formatDate)->latest()->get();
        return view('backend.report.report_by_date',compact('orders','formatDate'));
    }
    // END FUNCTION
    
    
    public function SearchByYearMonth(Request $request){
        $month = $request->month;
        $year = $request->year_name;
        
        $orders = Order::where('order_month', $month)->where('order_year', $year)->get();
        return view('backend.report.report_by_year_month',compact('orders','month','year'));
    }
    // END FUNCTION
    
    public function SearchByYearOnly(Request $request){
        $year = $request->year;
        $orders = Order::where('order_year', $year)->get();
        return view('backend.report.report_by_year_only',compact('orders','year'));
    }
    // END FUNCTION
    
    public function OrderByUser(){
        $users = User::where('role','user')->latest()->get();
        return view('backend.report.report_by_user',compact('users'));
    }
    // END FUNCTION
    

    public function SearchByUser(Request $request)
    {
        $userId = $request->user;

        // Retrieve the user's name using the user ID
        $user = User::findOrFail($userId);
        $userName = $user->name;

        // Retrieve orders for the selected user
        $orders = Order::where('user_id', $userId)->get();

        return view('backend.report.order_report_by_user', compact('orders', 'userName'));
    }

}
