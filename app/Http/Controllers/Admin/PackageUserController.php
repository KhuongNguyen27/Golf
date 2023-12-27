<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use App\Models\Package;
use App\Models\User;
use App\Repositories\Eloquents\PackageUserRepository;
use App\Repositories\Eloquents\PackageRepository;

use App\Http\Requests\StorePackageUserRequest;
use App\Http\Requests\UpdatePackageRequest;


class PackageUserController extends AdminController
{
    protected $packageuserService;
    protected $packageService;
    protected $route_prefix = "admin.packageusers.";
    protected $link_view = "admin.packages.package_user.";
    public function __construct(PackageUserRepository $packageuserService,PackageRepository $packageService)
    {
        $this->packageuserService = $packageuserService;
        $this->packageService = $packageService;
    }   
    function index(Request $request){
        $package_id = $request->package_id;
        $package = $this->packageService->find($package_id);
        $items = $this->packageuserService->all($request);
        $param = [
            'items' => $items,
            'package' => $package,
            'route_prefix' => $this->route_prefix,
        ];
        return view($this->link_view.'index', $param);
    }
    function create(Request $request){
        $users = User::all();
        $param = [
            'request'=>$request,
            'route_prefix' => $this->route_prefix,
            'users'=>$users,
            ];
        return view($this->link_view.'create',$param);
    }
    function store(StorePackageUserRequest $request){
        try {
            $data = $request->except('_method','_token');
            $item = $this->packageuserService->store($data);
            return redirect()->route($this->route_prefix.'index',$data['package_id'])->with('success','Thêm thành công');
        } catch (Exception $e) {
            Log::error('Bug error : '.$e->getMessage());
            return redirect()->route($this->route_prefix.'index',$data['package_id'])->with('error','Thêm thất bại');
        }
    }
    function destroy($id){
        try {
            $item = $this->packageuserService->destroy($id);
            return back()->with('success','Xóa thành công');
        } catch (Exception $e) {
            Log::error('Bug error : '.$e->getMessage());
            return back()->with('error','Xóa thất bại');
        }
    }
}