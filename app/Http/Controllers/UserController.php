<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Store;
use App\Models\Rol;
use App\Models\Department;
use App\Models\Designation;
use DB;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Auth;
class UserController extends Controller
{
    //


    public function index()
    {
        try {
            
            $store=Store::find(Auth::user()->store_id);
            $user_count = User::with('rol')->Store()->count();
            $user = User::with('rol')->Store()->get();
        return view('user.index',['user'=>$user,'user_count'=>$user_count,'store'=>$store]);
    } catch (\Exception $e) {
        return $e->getMessage();
      }
    }
    public function create() 
    {
        try {
            $user_count = User::Store()->count();
            $store=Store::find(Auth::user()->store_id);
            $department=Department::Store()->get();
            $designation=Designation::Store()->get();
            $rol=Rol::get();
        return view('user.create',['rol'=>$rol,'store'=>$store,'user_count'=>$user_count,'department'=>$department,'designation'=>$designation]);
    } catch (\Exception $e) {
        return $e->getMessage();
      }
    }
    public function store(UserRequest $request)
    {
        try { $store=Store::find(Auth::user()->store_id);
            $user_count = User::Store()->count();
            if($store->no_of_users>$user_count){
        DB::transaction(function () use ($request) {
        User::create_user($request);
        }); 
    }
        return back();   
    } catch (\Exception $e) {
        return $e->getMessage();
      }     
    
    }
    public function edit(User $user) 
    {
  
        try {
            $rol=Rol::get();
            return view('user.edit', [
                'user' => $user,'rol'=>$rol
            ]);
        } catch (\Exception $e) {
            return $e->getMessage();
          }
    }
    public function update(Request $request,User $user) {
   
        try {
   
            DB::transaction(function () use ($request,$user) {
                User::update_user($request,$user);
        }); 
       return redirect()->route('user.index')->with('success','User updated successfully');
    } catch (\Exception $e) {
        return $e->getMessage();
      }    
    }  
    public function destroy(User $user) 
    {
       
        try {
            DB::transaction(function () use ($user) {
            $user->delete();
        }); 
            return redirect()->route('user.index')->with('success','User deleted successfully');
        } catch (\Exception $e) {
            return $e->getMessage();
          }
      
    }
}
