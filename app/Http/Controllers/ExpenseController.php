<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ExpenseDetail;
use App\Models\ExpenseMaster;
use App\Models\Van;
use DB;
class ExpenseController extends Controller
{
    //
    public function index(Request $request)
    {
        
        try {
          $results = ExpenseMaster::Store()->orderBy('id','desc')->get();
            return view('expense-master.index',['results'=>$results]);

    } catch (\Exception $e) {
        return $e->getMessage();
      }
    }
   
    
     public function create() 
    {
        try {
          
        return view('expense-master.create');
    } catch (\Exception $e) {
        return $e->getMessage();
      }
    }
        public function store(Request $request)
    {
        try {
        //   return $request->all();
          
        DB::transaction(function () use ($request,&$results) {
            $results=ExpenseMaster::create_expense($request);
          
        });
      
        return back();   
    } catch (\Exception $e) {
        return $e->getMessage();
      }     
    
    }
     public function edit(ExpenseMaster $expenseMaster) 
    {
  
        try {
           
            return view('expense-master.edit', [
                'expenseMaster' => $expenseMaster
               
            ]);
        } catch (\Exception $e) {
            return $e->getMessage();
          }
    }
    public function update(Request $request,ExpenseMaster $expenseMaster) {
   
        try {

            DB::transaction(function () use ($request,$expenseMaster) {
                ExpenseMaster::update_expense($request,$expenseMaster);
        }); 
       return redirect()->route('expense-master.index')->with('Success',' updated successfully');
    } catch (\Exception $e) {
        return $e->getMessage();
      }    
    }  
    public function destroy(ExpenseMaster $expenseMaster) 
    {
       
        try {
            DB::transaction(function () use ($expenseMaster) {
            $expenseMaster->delete();
        }); 
            return redirect()->route('expense-master.index')->with('success',' deleted successfully');
        } catch (\Exception $e) {
            return $e->getMessage();
          }
      
    }
           
      
    
      
}
