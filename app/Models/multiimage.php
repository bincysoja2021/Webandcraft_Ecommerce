<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class multiimage extends Model
{
    use HasFactory;use SoftDeletes;
    protected $table="multiproductimage";
    protected $fillable = ['p_id','image'];

}
