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
        // return $request->all();
        try {
          $store=Store::find(Auth::user()->store_id);

        //   $fromDate =$store->created_at;
        $receipt = ReceiptVoucher::where('store_id',Auth::user()->store_id)->orderBy('id','ASC')->first();
        $payment=PaymentVoucher::where('store_id',Auth::user()->store_id)->orderBy('id','ASC')->first();
        if ($receipt && $payment) {
    // Compare dates if both records are found
    if ($receipt->in_date > $payment->in_date) {
        $fromDate = $receipt->in_date;
    } else {
        $fromDate = $payment->in_date;
    }
} elseif ($receipt) {
    // If only receipt is found
    $fromDate = $receipt->in_date;
} elseif ($payment) {
    // If only payment is found
    $fromDate = $payment->in_date;
} else {
    // Handle the case where neither receipt nor payment is found
    $fromDate =  Carbon::now(); // Set a default value or handle it as needed
}
       
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
      
      return view('reports.monthly-share',['months'=>$months,'income'=>$income,'expense'=>$expense,'profit'=>$profit,'selectmonth'=>$month,'partnerStore'=>$partnerStore]);

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
