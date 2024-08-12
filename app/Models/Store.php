<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
class Store extends Model
{
    protected $table = 'store';
    protected $fillable = ['id', 'name','comapny_id','logo','address','emirate','country','contact_number','whatsapp_number','email','username','password','no_of_users','suscription_end_date','buffer_days','description','currency','vat_percentage','trn','status'];
    use HasFactory,SoftDeletes;
    public static function create_store($request,$image)
    {
        $request['logo']=$image;
        self::create($request->all());
        $user = User::create([
            'name' => $request->name,
            'email' => $request->username,
            'password' => Hash::make($request->password),
            'is_shop_admin' => 1,
        ]);
    }
    public static function update_store($request,$store,$image)
    {
        $request['logo']=$image;
        $store->update($request->all());
    }
    public function scopeActive($query)
    {
         return $query->where('status',1)->orderBy('id', 'asc');
    }
    public function scopeDeactive($query)
    {
         return $query->where('status',0)->orderBy('id', 'asc');
    }
   
     
}
