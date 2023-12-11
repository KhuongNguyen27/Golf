<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Duration extends Model
{
    use HasFactory;
    protected $table = 'durations';

    //Relationship
    protected $fillable = [
        'name',
        'amount',
        'unit'
    ];
    function package(){
        return $this->hasMany(Package::class);
    }
}