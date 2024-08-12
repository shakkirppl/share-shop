<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\IncomeMaster;
use App\Models\Van;
use DB;
class IncomeController extends Controller
{
    //
    public function index(Request $request)
    {
        
        try {
          $results = IncomeMaster::Store()->orderBy('id','desc')->get();
            return view('income-master.index',['results'=>$results]);

    } catch (\Exception $e) {
        return $e->getMessage();
      }
    }
   
    
     public function create() 
    {
        try {
          
        return view('income-master.create');
    } catch (\Exception $e) {
        return $e->getMessage();
      }
    }
        public function store(Request $request)
    {
        try {
        //   return $request->all();
          
        DB::transaction(function () use ($request,&$results) {
            $results=IncomeMaster::create_income($request);
          
        });
      
        return back();   
    } catch (\Exception $e) {
        return $e->getMessage();
      }     
    
    }
     public function edit(IncomeMaster $incomeMaster) 
    {
  
        try {
           
            return view('income-master.edit', [
                'incomeMaster' => $incomeMaster
               
            ]);
        } catch (\Exception $e) {
            return $e->getMessage();
          }
    }
    public function update(Request $request,IncomeMaster $incomeMaster) {
   
        try {

            DB::transaction(function () use ($request,$incomeMaster) {
                ExpenseMaster::update_expense($request,$incomeMaster);
        }); 
       return redirect()->route('income-master.index')->with('Success',' updated successfully');
    } catch (\Exception $e) {
        return $e->getMessage();
      }    
    }  
    public function destroy(IncomeMaster $incomeMaster) 
    {
       
        try {
            DB::transaction(function () use ($incomeMaster) {
            $incomeMaster->delete();
        }); 
            return redirect()->route('income-master.index')->with('success',' deleted successfully');
        } catch (\Exception $e) {
            return $e->getMessage();
          }
      
    }
           
      
    
      
}
