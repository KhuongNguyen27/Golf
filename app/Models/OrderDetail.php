<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;
    protected $table = "orderdetails";
    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'total',
    ];

    // Relationship
    function order(){
        return $this->belongsTo(Order::class);
    }
    function product(){
        return $this->belongsTo(Product::class);
    }

    // Feature
    const ACTIVE = 1;
    const INACTIVE = 0;
    function getProductNameAttribute(){
        return $this->product ? $this->product->name : "";
    }
    function getTotalFmAttribute(){
        return $this->total ? number_format(intval($this->total), 0, ',', '.').' VNĐ' : '';
    }
    function getPriceFmAttribute(){
        return $this->product->price ? number_format(intval($this->product->price), 0, ',', '.').' VNĐ' : '';
    }
}