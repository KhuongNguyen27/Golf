<?php

namespace App\Http\Controllers\Admin;

use App\Models\UserProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Repositories\Eloquents\UserProductRepository;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Log;

class UserProductController extends AdminController
{
    protected $productService;
    public function __construct(UserProductRepository $productService)
    {
        $this->productService = $productService;
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
            return redirect()->route('admin.packages.index')->with('error','Vui lòng thử lại');
        }
    }
    function storePro(Request $request){
        try {
            $data = $request->except('_method','_token');
            $data['package_id'] = 1;
            $this->productService->store($data);
            return redirect()->route('admin.packages.show',1)->with('error','Thêm thành công');
        } catch (\Exception $e) {
            Log::error('Bug error : '.$e->getMessage());
            return redirect()->route('admin.packages.show',1)->with('error','Thêm thất bại');
        }
    }
    function storeSingle(Request $request){
        try {
            $data = $request->except('_method','_token');
            $data['package_id'] = 2;
            if ($data['is_3d']=="false") {
                $this->productService->store($data);
            }else{
                $this->productService->store35($data);
            }
            return redirect()->route('admin.packages.show',2)->with('error','Thêm thành công');
        } catch (\Exception $e) {
            Log::error('Bug error : '.$e->getMessage());
            return redirect()->route('admin.packages.show',2)->with('error','Thêm thất bại');
        }
    }
    function store10(Request $request){
        try {
            $data = $request->except('_method','_token');
            $data['package_id'] = 3;
            $this->productService->store($data);
            return redirect()->route('admin.packages.show',3)->with('error','Thêm thành công');
        } catch (\Exception $e) {
            Log::error('Bug error : '.$e->getMessage());
            return redirect()->route('admin.packages.show',3)->with('error','Thêm thất bại');
        }
    }
    function store35(Request $request){
        try {
            $data = $request->except('_method','_token');
            $data['package_id'] = 4;
            $this->productService->store35($data);
            return redirect()->route('admin.packages.show',4)->with('error','Thêm thành công');
        } catch (\Exception $e) {
            Log::error('Bug error : '.$e->getMessage());
            return redirect()->route('admin.packages.show',4)->with('error','Thêm thất bại');
        }
    }

    function show(Request $request){
        try {
            $package_id = $request->package_id;
            $user_id = $request->user_id;
            $is_3D = $request->is_3D;
            $items = $this->productService->show($package_id, $user_id);
            switch ($package_id) {
                case 1 :
                    return view('admin.packages.package_user.pro.show',compact('items'));
                    break;
                case 2 :
                    if ($is_3D) {
                        return view('admin.packages.package_user.single.show3D',compact('items'));
                    }else{
                        return view('admin.packages.package_user.single.show',compact('items'));
                    }
                    break;
                case 3 :
                    return view('admin.packages.package_user.session10.show',compact('items'));
                    break;
                case 4 :
                    return view('admin.packages.package_user.hour35.show',compact('items'));
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
            switch ($package_id) {
                case 1 :
                    return view('admin.packages.package_user.pro.edit',compact('item'));
                    break;
                case 2 :
                    return view('admin.packages.package_user.single.edit',compact('item'));
                    break;
                case 3 :
                    return view('admin.packages.package_user.session10.edit',compact('item'));
                    break;
                case 4 :
                    return view('admin.packages.package_user.hour35.edit',compact('item'));
                    break;
            }
        } catch (\Exception $e) {
            Log::error('Bug error : '.$e->getMessage());
            return redirect()->route('admin.packages.show',3)->with('error','Vui lòng thử lại');
        }
    }
    function update(Request $request,String $id){
        try {
            $data = $request->except('_method','_token');
            $productUser = $this->productService->find($id);
            $this->productService->update($data,$id);      
            return redirect()->route('admin.userproducts.showuser',['user_id' => $productUser->user_id, 'package_id' => $productUser->package_id])->with('success','Cập nhập thành công');
        } catch (\Exception $e) {
            Log::error('Bug error : '.$e->getMessage());
            return back()->with('error','Cập nhập thất bại');
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