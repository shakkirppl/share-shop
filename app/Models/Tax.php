<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;
class Tax extends Model
{
    protected $table = 'taxes';
    protected $fillable = ['id', 'name','percentage','store_id','description'];
    use HasFactory,SoftDeletes;
    public static function create_tax($request)
    {
        $request['store_id']=Auth::user()->store_id;
        self::create($request->all());
    }
    public static function update_tax($request,$taxes)
    {
        $request['store_id']=Auth::user()->store_id;
        $taxes->update($request->all());
    }
   
    public function scopeStore($query)
    {
         return $query->where('store_id',Auth::user()->store_id);
    }
}
