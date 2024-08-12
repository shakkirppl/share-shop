<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CompanyType;
use App\Models\Store;
use App\Models\Renewal;
use App\Http\Requests\StoreRequest;
use App\Http\Requests\RenewelRequest;
use DB;
use Carbon\Carbon;
use App\Helper\File;
use Illuminate\Support\Facades\Auth;
class StoreController extends Controller
{
    use File;
    //
    public function index()
    {
    //     try {
    //         $store = Store::get();
    //     return view('store.index',['store'=>$store]);
    // } catch (\Exception $e) {
    //     return $e->getMessage();
    //   }
    }

    public function create() 
    {
    //     try {
    //         $CompanyType=CompanyType::Active()->get();
    //     return view('store.create',['company'=>$CompanyType]);
    // } catch (\Exception $e) {
    //     return $e->getMessage();
    //   }
    }
    public function store(StoreRequest $request)
    {
    //     try {
    //         if( $file = $request->file('image') ) {
    //             $path = 'uploads/motors';
    //             $image = $this->file($file,$path,150,150);
    //         }else{$image='defalut.jpg';}
    //     DB::transaction(function () use ($request,$image) {
    //         Store::create_store($request,$image);
    //     }); 
    //     return back();   
    // } catch (\Exception $e) {
    //     return $e->getMessage();
    //   }     
    
    }
    public function edit() 
    {
  
        try {
        
            $store=Store::find(Auth::user()->store_id);
            $CompanyType=CompanyType::Active()->get();
            return view('store.edit', [
                'store' => $store,'company'=>$CompanyType
            ]);
        } catch (\Exception $e) {
            return $e->getMessage();
          }
    }
    public function update(StoreRequest $request,Store $store) {
   
        try {
            if( $file = $request->file('image') ) {
                            $path = 'uploads/store';
                            $image = $this->file($file,$path,150,150);
                        }else{$image=$store->image;}
            DB::transaction(function () use ($request,$store,$image) {
                Store::update_store($request,$store,$image);
        }); 
       return redirect()->route('profile-update')->with('success','Store updated successfully');
    } catch (\Exception $e) {
        return $e->getMessage();
      }    
    }  
    public function destroy(Store $store) 
    {
       
        try {
            DB::transaction(function () use ($store) {
            $store->delete();
        }); 
            return redirect()->route('store.index')->with('success','Store deleted successfully');
        } catch (\Exception $e) {
            return $e->getMessage();
          }
      
    }
    public function store_view( $id) 
    {
  
        try {
            
            $store=Store::find($id);
            $toDate = Carbon::parse($store->suscription_end_date);
            $fromDate = Carbon::parse(Carbon::now());
      if($store->suscription_end_date>=Carbon::now())
      { $pending_days =$toDate->diffInDays($fromDate); }
      else{$pending_days =$toDate->diffInDays($fromDate);
        $pending_days =$pending_days*-1;}
            
            // $pending_days=Carbon::now()->subDays(7)->toDateString();
            return view('store.view', [
                'store' => $store,'pending_days'=>$pending_days
            ]);
        } catch (\Exception $e) {
            return $e->getMessage();
          }
    }
    public function store_active( $id) 
    {
  
        try {
            $store=Store::find($id);
            $store->status=1;
            $store->save();
            return back();
        } catch (\Exception $e) {
            return $e->getMessage();
          }
    }
    public function store_deactive( $id) 
    {
  
        try {
            $store=Store::find($id);
            $store->status=0;
            $store->save();
            return back();
            
        } catch (\Exception $e) {
            return $e->getMessage();
          }
    }
    public function due_date()
    {
        try {
            $store = Store::where('suscription_end_date','<',Carbon::now())->get();
        return view('store.due-date',['store'=>$store]);
    } catch (\Exception $e) {
        return $e->getMessage();
      }
    }
    public function buffer_days()
    {
        try {
            $stors = Store::Active()->where('suscription_end_date','>',Carbon::now())->get();
            $result=[];
            foreach ($stors as $key => $stor) {
                # code...
            $toDate = Carbon::parse($stor->suscription_end_date);
            $fromDate = Carbon::parse(Carbon::now());
            $pending_days =$toDate->diffInDays($fromDate);
            if($stor->buffer_days>=$pending_days){
            $result[]=[$stor->id,$stor->name,$pending_days];
            }
              
            }
        
        return view('store.buffer-days',['result'=>$result]);
    } catch (\Exception $e) {
        return $e->getMessage();
      }
    }
    public function active_store()
    {
        try {
            $store = Store::Active()->get();
        return view('store.index',['store'=>$store]);
    } catch (\Exception $e) {
        return $e->getMessage();
      }
    }
    public function deactive_store()
    {
        try {
            $store = Store::Deactive()->get();
        return view('store.index',['store'=>$store]);
    } catch (\Exception $e) {
        return $e->getMessage();
      }
    }
    public function store_renewal( $id) 
    {
  
        try {
            $store=Store::find($id);
            return view('store.renewal',['store'=>$store]);
            
        } catch (\Exception $e) {
            return $e->getMessage();
          }
    }
    public function store_renewal_post(RenewelRequest $request)
    {
        try {
         
        DB::transaction(function () use ($request) {
            Renewal::create_renewel($request);
            $store=Store::find($request->store_id);
            $store->suscription_end_date=$request->suscription_end_date;
            $store->save();
        }); 
        return back();   
    } catch (\Exception $e) {
        return $e->getMessage();
      }     
    
    }
    
    
}
