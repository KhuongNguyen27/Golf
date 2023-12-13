<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    protected $pro;
    protected $single;
    protected $session10;
    protected $hour35;
    public function __construct()
    {
        $this->pro     = 1;
        $this->single  = 2;
        $this->session10  = 3;
        $this->hour35     = 4;
    }  
}