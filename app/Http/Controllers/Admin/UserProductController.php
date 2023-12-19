<?php

namespace App\Http\Controllers\Admin;

use App\Models\UserProduct;
use App\Models\PackageUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Repositories\Eloquents\UserProductRepository;
use App\Repositories\Eloquents\PackageUserRepository;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Log;

class UserProductController extends AdminController
{
    protected $productService;
    protected $packageuserService;
    public function __construct(UserProductRepository $productService,PackageUserRepository $packageuserService)
    {
        $this->productService = $productService;
        $this->packageuserService = $packageuserService;
    }
    function create3D(Request $request){
        $package_id = $request->package_id;
            $id = $request->user_id;
            $param = [
                'package_id' => $package_id,
                'id'=> $id
            ];
        return view('admin.packages.package_user.single.create3D',$param);
    }
    function create(Request $request){
        try {
            $package_id = $request->package_id;
            $id = $request->user_id;
            $param = [
                'package_id' => $package_id,
                'id'=> $id
            ];
            switch ($package_id) {
                case 1 :
                    return view('admin.packages.package_user.pro.create',$param);
                    break;
                case 2 :
                    return view('admin.packages.package_user.single.create',$param);
                    break;
                case 3 :
                    return view('admin.packages.package_user.session10.create',$param);
                    break;
                case 4 :
                    return view('admin.packages.package_user.hour35.create',$param);
                    break;
            }
        } catch (\Exception $e) {
            Log::error('Bug error : '.$e->getMessage());
            return redirect()->route('admin.packages.show',$id)->with('error','Vui lòng thử lại');
        }
    }
    function store(Request $request){
        try {
            $data = $request->except('_method','_token');
            $package_id = $request->package_id;
            $user_id = $request->user_id;
            $this->productService->store($data);
            return redirect()->route('admin.userproducts.showuser',[$user_id,$package_id])->with('error','Thêm thành công');
        } catch (\Exception $e) {
            Log::error('Bug error : '.$e->getMessage());
            return redirect()->route('admin.userproducts.showuser',[$user_id,$package_id])->with('error','Thêm thất bại');
        }
    }

    function show(Request $request){
        try {
            $package_id = $request->package_id;
            $user_id = $request->user_id;
            $is_3D = $request->is_3D;
            $item = PackageUser::where('user_id',$user_id)->where('package_id',$package_id)->first();
            $items = $this->productService->show($package_id, $user_id);
            $param=[
                'package_id' => $package_id,
                'user_id' => $user_id,
                'is_3D' => $is_3D,
                'items' => $items,
                'item' => $item,
            ];
            switch ($package_id) {
                case 1 :
                    return view('admin.packages.package_user.pro.show',$param);
                    break;
                case 2 :
                    if ($is_3D) {
                        return view('admin.packages.package_user.single.show3D',$param);
                    }else{
                        return view('admin.packages.package_user.single.show',$param);
                    }
                    break;
                case 3 :
                    return view('admin.packages.package_user.session10.show',$param);
                    break;
                case 4 :
                    return view('admin.packages.package_user.hour35.show',$param);
                    break;
            }
        } catch (\Exception $e) {
            Log::error('Bug error : '.$e->getMessage());
            return redirect()->route('admin.packages.show',$package_id)->with('error','Vui lòng thử lại');
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
                    return view('admin.packages.package_user.pro.edit',$param);
                    break;
                case 2 :
                    return view('admin.packages.package_user.single.edit',$param);
                    break;
                case 3 :
                    return view('admin.packages.package_user.session10.edit',$param);
                    break;
                case 4 :
                    return view('admin.packages.package_user.hour35.edit',$param);
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
            return view('admin.packages.package_user.single.edit3D',$param);
        } catch (\Exception $e) {
            Log::error('Bug error : '.$e->getMessage());
            return redirect()->route('admin.userproducts.showuser',[$user_id,$package_id])->with('error','Vui lòng thử lại');
        }
    }
    function update(Request $request,String $id){
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