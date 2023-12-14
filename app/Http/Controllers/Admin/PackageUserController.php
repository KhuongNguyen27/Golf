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
    function expiration(Request $request){
        try {
            $data = $request->except('_method','_token');
            $this->packageuserService->expiration($data);
            return back()->with('Success','Gia hạn thành công');
        } catch (Exception $e) {
            Log::error("Bug error : ".$e->getMessage());
            return back()->with('error','Vui lòng thử lại');
        }
    }
}
