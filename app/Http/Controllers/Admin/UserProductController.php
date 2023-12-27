<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Log;

use App\Models\UserProduct;
use App\Models\PackageUser;

use App\Repositories\Eloquents\UserProductRepository;
use App\Repositories\Eloquents\PackageUserRepository;

use App\Http\Requests\StoreUserProductRequest;
use App\Http\Requests\UpdateUserProductRequest;

class UserProductController extends AdminController
{
    protected $productService;
    protected $packageuserService;
    protected $link_view = 'admin.packages.package_user.';
    protected $route_prefix = 'admin.userproducts.';
    public function __construct(UserProductRepository $productService,PackageUserRepository $packageuserService)
    {
        $this->productService = $productService;
        $this->packageuserService = $packageuserService;
    }
    function index(Request $request){
        try {
            $package_user_id = $request->package_user_id;
            $is_3D = $request->is_3D;
            $item = $this->packageuserService->find($package_user_id);
            $items = $this->productService->all($package_user_id);
            $param=[
                'is_3D' => $is_3D,
                'items' => $items,
                'item' => $item,
            ];
            switch ($package_id) {
                case 1 :
                    return view($this->link_view.'pro.index',$param);
                    break;
                case 2 :
                    if ($is_3D) {
                        return view($this->link_view.'single.index3D',$param);
                    }else{
                        return view($this->link_view.'single.index',$param);
                    }
                    break;
                case 3 :
                    return view($this->link_view.'session10.index',$param);
                    break;
                case 4 :
                    return view($this->link_view.'hour35.index',$param);
                    break;
            }
        } catch (\Exception $e) {
            Log::error('Bug error : '.$e->getMessage());
            return redirect()->route('admin.packageusers.index',$item->package_id)->with('error','Vui lòng thử lại');
        }
    }
    function create3D(Request $request){
        $package_id = $request->package_id;
            $id = $request->user_id;
            $param = [
                'package_id' => $package_id,
                'id'=> $id
            ];
        return view($this->link_view.'single.create3D',$param);
    }
    function create(Request $request){
        try {
            $package_user_id = $request->package_user_id;
            $item = $this->packageuserService->find($package_user_id);
            $param = [
                'item' => $item,
                'route_prefix' => $this->route_prefix
            ];
            switch ($item->package_id) {
                case 1 :
                    return view($this->link_view.'pro.create',$param);
                    break;
                case 2 :
                    return view($this->link_view.'single.create',$param);
                    break;
                case 3 :
                    return view($this->link_view.'session10.create',$param);
                    break;
                case 4 :
                    return view($this->link_view.'hour35.create',$param);
                    break;
            }
        } catch (\Exception $e) {
            Log::error('Bug error : '.$e->getMessage());
            return redirect()->route('admin.packageusers.index',$item->package_id)->with('error','Vui lòng thử lại');
        }
    }
    function store(StoreUserProductRequest $request){
        try {
            $data = $request->except('_method','_token');
            $package_user_id = $data['package_user_id'];
            $item = $this->packageuserService->find($package_user_id);
            $data['item'] = $item;
            $this->productService->store($data);
            return redirect()->route($this->route_prefix.'index',$item->id)->with('error','Thêm thành công');
        } catch (\Exception $e) {
            Log::error('Bug error : '.$e->getMessage());
            return redirect()->route($this->route_prefix.'index',$item->id)->with('error','Thêm thất bại');
        }
    }
    function edit($id){
        try {
            $item = $this->productService->find($id);
            $package_id = $item->package_id;
            $user_id = $item->user_id;
            $param=[
                'item' => $item
            ];
            switch ($package_id) {
                case 1 :
                    return view($this->link_view.'pro.edit',$param);
                    break;
                case 2 :
                    return view($this->link_view.'single.edit',$param);
                    break;
                case 3 :
                    return view($this->link_view.'session10.edit',$param);
                    break;
                case 4 :
                    return view($this->link_view.'hour35.edit',$param);
                    break;
            }
        } catch (\Exception $e) {
            Log::error('Bug error : '.$e->getMessage());
            return redirect()->route('admin.userproducts.showuser',[$user_id,$package_id])->with('error','Vui lòng thử lại');
        }
    }
    function edit3d($id){
        try {
            $item = $this->productService->find($id);
            $package_id = $item->package_id;
            $user_id = $item->user_id;
            $param=[
                'item' => $item
            ];
            return view($this->link_view.'single.edit3D',$param);
        } catch (\Exception $e) {
            Log::error('Bug error : '.$e->getMessage());
            return redirect()->route('admin.userproducts.showuser',[$user_id,$package_id])->with('error','Vui lòng thử lại');
        }
    }
    function update(UpdateUserProductRequest $request,String $id){
        try {
            $item = $this->productService->find($id);
            $package_id = $item->package_id;
            $user_id = $item->user_id;
            $data = $request->except(['_method','_token']);
            $item = $this->productService->update($data,$id);
            return redirect()->route('admin.userproducts.showuser',['user_id' => $user_id,'package_id' => $package_id])->with('success','Cập nhập thành công');
        } catch (Exception $e) {
            Log::error('Bug error : '.$e->getMessage());
            return redirect()->route('admin.userproducts.showuser',['user_id' => $user_id,'package_id' => $package_id])->with('error','Cập nhập thất bại');
        }
    }
    function destroy($id){
        try {
            $productUser = $this->productService->find($id);
            $user_id = $productUser->user_id;
            $package_id = $productUser->package_id;
            $this->productService->destroy($id);      
            return redirect()->route('admin.userproducts.showuser',['user_id' => $user_id, 'package_id' => $package_id])->with('success','Xóa thành công');
        } catch (\Exception $e) {
            Log::error('Bug error : '.$e->getMessage());
            return back()->with('error','Xóa thất bại');
        }
    }
}