<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ReceiptVoucher;
use App\Models\Customer;
use App\Models\IncomeMaster;
use DB;
class ReceiptVoucherController extends Controller
{
    //

    public function index()
    {
        try {
            $receipt = ReceiptVoucher::with('receipt')->Store()->get();
        return view('receipt-voucher.index',['receipt'=>$receipt]);
    } catch (\Exception $e) {
        return $e->getMessage();
      }
    }

    public function create() 
    {
        try {
            $receipt=IncomeMaster::Store()->get();
        return view('receipt-voucher.create',['receipt'=>$receipt]);
    } catch (\Exception $e) {
        return $e->getMessage();
      }
    }
    public function store(Request $request)
    {
      
        try {
    
          
        DB::transaction(function () use ($request) {
            ReceiptVoucher::create_receipt_voucher($request);
        }); 
        return back();   
    } catch (\Exception $e) {
        return $e->getMessage();
      }     
    
    }
    // public function edit(Category $category) 
    // {
  
    //     try {
    //         return view('category.edit', [
    //             'category' => $category
    //         ]);
    //     } catch (\Exception $e) {
    //         return $e->getMessage();
    //       }
    // }
    // public function update(Request $request,Category $category) {
   
    //     try {
           
    //         DB::transaction(function () use ($request,$category) {
    //             Category::update_category($request,$category);
    //     }); 
    //    return redirect()->route('category.index')->with('success','Category updated successfully');
    // } catch (\Exception $e) {
    //     return $e->getMessage();
    //   }    
    // }  
    public function destroy(ReceiptVoucher $receipt_voucher) 
    {
       
        try {
            DB::transaction(function () use ($receipt_voucher) {
            $receipt_voucher->delete();
        }); 
            return redirect()->route('receipt-voucher.index')->with('Receipt Voucher','Receipt deleted successfully');
        } catch (\Exception $e) {
            return $e->getMessage();
          }
      
    }
    public function receipt_voucher_report(Request $request)
    {
        
        try {
         
          $from_date=$request->from_date;
       $to_date=$request->to_date;
          $results = ReceiptVoucher::with('user','receipt')->Intwodate($from_date,$to_date)->Store()->orderBy('id','desc')->get();
            return view('receipt-voucher.report',['results'=>$results]);

    } catch (\Exception $e) {
        return $e->getMessage();
      }
    }
    
}
