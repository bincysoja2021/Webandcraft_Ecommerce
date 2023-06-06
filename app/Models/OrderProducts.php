<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderProducts extends Model
{
    use HasFactory;
    protected $table="orderproducts";
    protected $fillable = ['id','product','qty','order_id','total_amount'];

    public function products()
    {
        return $this->hasOne('App\Models\Product','id','product');
    } 

}
