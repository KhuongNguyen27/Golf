<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;
    protected $table = 'packages';
    protected $fillable = [
        'name',
        'price',
        'duration_id',
        'status'
    ];
    
    //Relationship
    function duration(){
        return $this->belongsTo(Duration::class);
    }
    function package_user(){
        return $this->hasMany(PackageUser::class);
    }
    function users(){
        return $this->belongsToMany(User::class,'package_user');
    }

    //Feature 
    const ACTIVE = 1;
    const INACTIVE = 0;
    function getDurationNameAttribute(){
        return $this->duration ? $this->duration->name : "";
    }
    function getDurationAmountAttribute(){
        return $this->duration ? $this->duration->amount : "";
    }
    function getDurationUnitAttribute(){
        return $this->duration ? $this->duration->unit : "";
    }
    function getStatusFmAttribute(){
        if($this->status == self::INACTIVE){
            return '<span class="badge badge-warning">Tạm Dừng</span>';
        }else{
            return '<span class="badge badge-success">Hoạt Động</span>';
        }
    }

}