<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Store;
use DB;
use App\Models\PaymentVoucher;
use App\Models\ReceiptVoucher;
use App\Models\PartnerStore;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Artisan;
use Illuminate\Support\Collection;
class MainController extends Controller
{
    //
    
    
  
 public function monthly_share_report(Request $request)
    {
        
        try {
          $store=Store::find(Auth::user()->store_id);

          // $fromDate =$store->created_at;
          $fromDate ='2024-08-08 02:00:22';
          $toDate = Carbon::now();
          $start = Carbon::parse($fromDate)->startOfMonth();
          $end = Carbon::parse($toDate)->endOfMonth();
      
          $months = new Collection();
      
          while ($start->lte($end)) {
              $months->push($start->format('F Y')); // e.g., "January 2024"
              $start->addMonth();
          }
          $month = $request->month;

// Get the start date of the month
      $startDate = Carbon::parse($month)->startOfMonth()->toDateString();

// Get the end date of the month
      $endDate = Carbon::parse($month)->endOfMonth()->toDateString();
      $income = ReceiptVoucher::where('store_id',Auth::user()->store_id)
      ->whereBetween('in_date', [$startDate, $endDate])
      ->sum('total_amount');
      $expense=PaymentVoucher::where('store_id',Auth::user()->store_id)->WhereBetween('in_date',[$startDate,$endDate])->sum('total_amount');
      $profit=$income-$expense;
      $partnerStore=PartnerStore::with('partner')->where('store_id',$store->id)->get();
      return view('reports.monthly-share',['months'=>$months,'income'=>$income,'expense'=>$expense,'profit'=>$profit,'month'=>$month,'partnerStore'=>$partnerStore]);

    } catch (\Exception $e) {
        return $e->getMessage();
      }
    }
    
      
 public function monthly_report_detail($month)
 {
     
     try {
       $store=Store::find(Auth::user()->store_id);


// Get the start date of the month
   $startDate = Carbon::parse($month)->startOfMonth()->toDateString();

// Get the end date of the month
   $endDate = Carbon::parse($month)->endOfMonth()->toDateString();
   $receipt=ReceiptVoucher::with('receipt')->Store()->WhereBetween('in_date',[$startDate,$endDate])->get();
   $payment=PaymentVoucher::with('expense')->Store()->WhereBetween('in_date',[$startDate,$endDate])->get();

   $partnerStore=PartnerStore::with('partner')->where('store_id',$store->id)->get();
   return view('reports.monthly-report-detail',['receipt'=>$receipt,'payment'=>$payment,'month'=>$month]);

 } catch (\Exception $e) {
     return $e->getMessage();
   }
 }
    
                   
      
    
}
