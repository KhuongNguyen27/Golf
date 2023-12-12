<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = 'orders';
    protected $fillable = [
        'user_id',
        'total',
        'note',
    ];
    // Relationship
    function orderdetail(){
        return $this->hasMany(OrderDetail::class);
    }
    function products(){
        return $this->belongsToMany(Product::class,'orderdetails','order_id','product_id');
    }
    function user(){
        return $this->belongsTo(User::class);
    }

    // Feature
    const ACTIVE = 1;
    const INACTIVE = 0;
    function getUserNameAttribute(){
        return $this->user ? $this->user->name : "";
    }
}