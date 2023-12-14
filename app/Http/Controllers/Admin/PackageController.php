<?php
namespace App\Http\Controllers\Admin;

use App\Http\Requests\StorePackageUserRequest;
use App\Http\Requests\UpdatePackageRequest;
use Illuminate\Http\Request;
use App\Models\Package;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Repositories\Eloquents\PackageRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Log;

class PackageController extends AdminController
{
    protected $packageService;
    public function __construct(PackageRepository $packageService)
    {
        $this->packageService = $packageService;
    }   
    public function index(Request $request)
    {
        $items = $this->packageService->all();
        $param =
        [
            'items' => $items,
        ];
        return view('admin.packages.index', $param);
    }
    public function show(String $id){
        $items = $this->packageService->show($id);
        $package = $this->packageService->find($id);
        $param = [
            'items' => $items,
            'package' => $package
    ];
    return view('admin.packages.show', $param);
    }
    function create(Request $request){
        $users = User::all();
        $param = [
            'id'=>$request->id,
            'users'=>$users,
            ];
        return view('admin.packages.create',$param);
    }
    function store(StorePackageUserRequest $request){
        try {
            $data = $request->except('_method','_token');
            $item = $this->packageService->store($data);
            return redirect()->route('admin.packages.show',$data['package_id'])->with('success','Thêm thành công');
        } catch (Exception $e) {
            Log::error('Bug error : '.$e->getMessage());
            return redirect()->route('admin.packages.index',$data['package_id'])->with('error','Thêm thất bại');
        }
    }
}