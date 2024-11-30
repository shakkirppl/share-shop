<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PaymentVoucher;
use App\Models\Customer;
use App\Models\ExpenseMaster;
use DB;
class PaymentVoucherController extends Controller
{
    //

    public function index()
    {
        try {
            $payment = PaymentVoucher::with('expense')->Store()->get();
        return view('payment-voucher.index',['payment'=>$payment]);
    } catch (\Exception $e) {
        return $e->getMessage();
      }
    }

    public function create() 
    {
        try {
            $expense=ExpenseMaster::Store()->get();
        return view('payment-voucher.create',['expense'=>$expense]);
    } catch (\Exception $e) {
        return $e->getMessage();
      }
    }
    public function store(Request $request)
    {
      
        try {
    
          
        DB::transaction(function () use ($request) {
            PaymentVoucher::create_payment_voucher($request);
        }); 
        return back();   
    } catch (\Exception $e) {
        return $e->getMessage();
      }     
    
    }
   public function edit(PaymentVoucher $paymentVoucher) 
    {
  
        try {
            $expense=ExpenseMaster::Store()->get();
            return view('payment-voucher.edit', [
                'paymentVoucher' => $paymentVoucher,
                'expense'=>$expense
            ]);
        } catch (\Exception $e) {
            return $e->getMessage();
          }
    }
    public function update(Request $request,PaymentVoucher $paymentVoucher) {
   
        try {
           
            DB::transaction(function () use ($request,$paymentVoucher) {
                PaymentVoucher::update_payment($request,$paymentVoucher);
        }); 
       return redirect()->route('payment-voucher.index')->with('success','Payment Voucher updated successfully');
    } catch (\Exception $e) {
        return $e->getMessage();
      }    
    }  
    public function destroy(PaymentVoucher $payment_voucher) 
    {
       
        try {
            DB::transaction(function () use ($payment_voucher) {
            $payment_voucher->delete();
        }); 
            return redirect()->route('payment-voucher.index')->with('Payment Voucher','Category deleted successfully');
        } catch (\Exception $e) {
            return $e->getMessage();
          }
      
    }
    public function payment_voucher_report(Request $request)
    {
        
        try {
         
          $from_date=$request->from_date;
       $to_date=$request->to_date;
          $results = PaymentVoucher::with('user','expense')->Intwodate($from_date,$to_date)->Store()->orderBy('id','desc')->get();
            return view('payment-voucher.report',['results'=>$results]);

    } catch (\Exception $e) {
        return $e->getMessage();
      }
    }
    
}
