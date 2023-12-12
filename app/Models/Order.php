<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    function orderdetail(){
        return $this->hasMany(OrderDetail::class);
    }
    function products(){
        return $this->belongsToMany(Product::class,'orderdetails','order_id','product_id');
    }
}