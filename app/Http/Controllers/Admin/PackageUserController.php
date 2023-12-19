<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Repositories\Eloquents\PackageUserRepository;
use Illuminate\Support\Facades\Log;

class PackageUserController extends AdminController
{
    protected $packageuserService;
    public function __construct(PackageUserRepository $packageuserService)
    {
        $this->packageuserService = $packageuserService;
    }   
    
}