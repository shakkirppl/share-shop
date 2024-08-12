<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;
class ExpenseDocumentDetail extends Model
{
    protected $table = 'expense_document_detail';
    protected $fillable = ['id', 'expense_detail_id','document_name','store_id'];
    use HasFactory,SoftDeletes;
   

   
    public function scopeStore($query)
    {
         return $query->where('store_id',Auth::user()->store_id);
    }
}
