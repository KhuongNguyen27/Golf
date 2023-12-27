<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackageUser extends Model
{
    use HasFactory;
    protected $table = 'package_user';
    protected $fillable = [
        'package_id',
        'register_day',
        'activity_day',
        'expiration_date',
        'user_id',
        'rank_id',
        'total_hour',
        'used_numbers',
        'status'
    ];

    //Relationship
    function package(){
        return $this->belongsTo(Package::class);
    }
    function rank(){
        return $this->belongsTo(Rank::class);
    }
    function user(){
        return $this->belongsTo(User::class);
    }
    function expiration(){
        return $this->hasMany(Expiration::class);
    }
    function user_product(){
        return $this->hasMany(UserProduct::class);
    }

    //Feature
    const ACTIVE = 1;
    const INACTIVE = 0;
    function getStatusFmAttribute(){
        if($this->status == self::INACTIVE){
            return '<span class="badge badge-warning">Tạm Dừng</span>';
        }else{
            return '<span class="badge badge-success">Hoạt Động</span>';
        }
    }
    function getUserNameAttribute(){
        return $this->user ? $this->user->name : "";
    }
    function getRankNameAttribute(){
        return $this->rank ? $this->rank->name : "";
    }
    function getPackageNameAttribute(){
        return $this->package ? $this->package->name : "";
    }
    function deleteExpiration($id){
        Expiration::where('package_user_id', $id)->delete();
    }
    function deleteUserProduct($id){
        UserProduct::where('package_user_id', $id)->delete();
    }
}