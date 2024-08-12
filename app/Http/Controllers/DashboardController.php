<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Store;
class DashboardController extends Controller
{
    //
    public function dashboard()
    {
        try {
            if(Auth::user()->is_shop_admin==1){
            $name= Auth::user()->name;
            $total = 0;
            $active = 0;
            $deactive = 0;
            $due = 0;
            $recent_store=[];
            return view('admin',['now' => Carbon::now()->toDateString(),'name' => $name,'total'=>$total,'active'=>$active,'deactive'=>$deactive,'due'=>$due,'recent_store'=>$recent_store]);
            }else{Auth::guard('web')->logout();
            return redirect('/');
        }
    } catch (\Exception $e) {
        return $e->getMessage();
    }
    }
}
