<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $fillable = [
        'name',
        'discount',
        'price',
        'status',
    ];

    // Relationship
    function orderdetail(){
        return $this->hasMany(OrderDetail::class);
    }
    function orders(){
        return $this->belongsToMany(Order::class,'orderdetails');
    }
    // Feature
    const ACTIVE = 1;
    const INACTIVE = 0;
    function getStatusFmAttribute(){
        if($this->status == self::INACTIVE){
            return '<span class="badge badge-warning">Tạm Dừng</span>';
        }else{
            return '<span class="badge badge-success">Hoạt Động</span>';
        }
    }
    function getDiscountFmAttribute(){
        return $this->discount ? number_format(intval($this->discount), 0, ',', '.').' VNĐ' : 'Không hỗ trợ';
    }
    function getPriceFmAttribute(){
        return $this->price ? number_format(intval($this->price), 0, ',', '.').' VNĐ' : '';
    }
}