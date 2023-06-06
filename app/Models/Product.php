<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table="product";
    protected $fillable = ['id','name','image','cat_id','price'];

    
    public function cat_deatils()
    {
        return $this->hasOne('App\Models\Category','id','cat_id');
    } 

}
