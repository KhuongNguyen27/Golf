<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expiration extends Model
{
    use HasFactory;
    protected $table = 'expirations';
    protected $fillable = [
        'packageuser_id',
        'expiration_date',
        'description',
        'created_at',
    ];
    // RelationShip
    function package_user(){
        return $this->belongsTo(PackageUser::class,'packageuser_id','id');
    }
    //Feature
}