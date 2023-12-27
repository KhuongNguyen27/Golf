<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProduct extends Model
{
    use HasFactory;
    protected $table = 'user_product';
    protected $fillable = [
        'user_id',
        'package_id',
        'balls',
        'hour_to',
        'to_hour',
        'total_hour',
        'used_day',
    ];
    //Relationship
    function user(){
        return $this->belongsTo(User::class);
    }
    function package(){
        return $this->belongsTo(Package::class);
    }
    function package_user(){
        return $this->belongsTo(PackageUser::class);
    }

    //Feature
    function getUserNameAttribute(){
        return $this->user ? $this->user->name : "";
    }
}