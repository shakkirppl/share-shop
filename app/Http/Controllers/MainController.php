<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\DayClose;
use App\Models\Store;
use App\Models\ExternalCustomer;
use App\Models\ExternalExactCustomer;
use App\Models\ExternalExactProduct;
use App\Models\ExternalProduct;
use DB;
use App\Models\Customer;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Artisan;
class MainController extends Controller
{
    //
    
    public function royal(Request $request)
    {
        
        try {
          $royal=DB::table('royals')->get();
          foreach($royal as $roy)
          {
          $customer=Customer::find($roy->customer_id);
          $customer->route_id=$roy->Route_id;
          $customer->province_id=$roy->Province_id;
          $customer->save();

          }
      return 'complete';
         

    } catch (\Exception $e) {
        return $e->getMessage();
      }
    }
    public function process_pending_data(Request $request)
    {
        
        try {
          $store_id=Auth::user()->store_id;
          $store=Store::find($store_id);
          $customer_count=ExternalCustomer::UnSynchData()->Store($store->code)->count('id');
          $product_count=ExternalProduct::UnSynchData()->Store($store->code)->count('id');

          $exact_customer_count=ExternalExactCustomer::UnSynchData()->Store($store->code)->count('id');
          $exact_product_count=ExternalExactProduct::UnSynchData()->Store($store->code)->count('id');
            return view('aprovel-pending.external-data',['customer_count'=>$customer_count,'product_count'=>$product_count,'exact_customer_count'=>$exact_customer_count,'store_id'=>$store_id,'exact_product_count'=>$exact_product_count]);

    } catch (\Exception $e) {
        return $e->getMessage();
      }
    }
    
    public function customer_process(Request $request)
    {
        
        try {
        
          $customer=ExternalCustomer::UnSync_Data_to_Customer();
        
            return back();

    } catch (\Exception $e) {
        return $e->getMessage();
      }
    }
    public function product_process(Request $request)
    {
        
        try {
        
         
          $product=ExternalProduct::UnSync_Data_to_Product();
            return back();

    } catch (\Exception $e) {
        return $e->getMessage();
      }
    }
    public function customer_process_xact(Request $request)
    {
        
        try {
        
          Artisan::call('command:get-customers');
        
            return back();

    } catch (\Exception $e) {
        return $e->getMessage();
      }
    }
    public function product_process_xact(Request $request)
    {
        
        try {
        
          Artisan::call('command:get-product');
        
            return back();

    } catch (\Exception $e) {
        return $e->getMessage();
      }
    }
 public function pending_dayclose_aprovel(Request $request)
    {
        
        try {
          $results = DayClose::with('van','user')->Store()->Pending()->orderBy('id','desc')->get();
            return view('aprovel-pending.dayclose',['results'=>$results]);

    } catch (\Exception $e) {
        return $e->getMessage();
      }
    }
    
     public function dayclose_view($id)
    {
        
        try {
          $results = DayClose::with('van','user')->Store()->Pending()->orderBy('id','desc')->find($id);
            return view('aprovel-pending.dayclose-view',['results'=>$results]);

    } catch (\Exception $e) {
        return $e->getMessage();
      }
    }
         public function day_close_update(Request $request)
    {
        
        try {
              DB::transaction(function () use ($request) {
                 
            $results = DayClose::find($request->id);
            $results->approvel=1;
            $results->save();

        }); 
        
         return redirect('pending-dayclose-aprovel');

    } catch (\Exception $e) {
        return $e->getMessage();
      }
    }
    
     
    
                   
      
    
}
