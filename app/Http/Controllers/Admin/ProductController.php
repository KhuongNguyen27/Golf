<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use App\Repositories\Eloquents\ProductRepository;
use Illuminate\Support\Facades\Auth;
use App\Traits\UploadFileTrait;
use Illuminate\Support\Str;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Log;

class ProductController extends AdminController
{
    protected $productService;
    public function __construct(ProductRepository $productService)
    {
        $this->productService = $productService;
    }
    public function index(Request $request)
    {
        $items = $this->productService->all();
        $param =
        [
            'items' => $items,
        ];
        return view('admin.products.index', $param);
    }
    function create(){
        return view('admin.products.create');
    }
    function store(StoreProductRequest $request){
        try {
            $data = $request->except('_method','_token');
            $item = $this->productService->store($data);
            return redirect()->route('admin.products.index')->with('success','Thêm sản phẩm thành công');
        } catch (Exception $e) {
            Log::error('Bug error : '.$e->getMessage());
            return redirect()->route('admin.products.create')->with('error','Vui lòng thử lại');
        }
        
    }
    function edit(String $id){
        $item = $this->productService->find($id);
        $param = [
            'item' => $item,
        ];
        return view('admin.products.edit',$param);
    }
    function update(UpdateProductRequest $request,String $id){
        try {
            $data = $request->except('_method','_token');
            $item = $this->productService->update($data,$id);
            return redirect()->route('admin.products.index')->with('success','Cập nhập sản phẩm thành công');
        } catch (Exception $e) {
            Log::error('Bug error : '.$e->getMessage());
            return redirect()->route('admin.products.create')->with('error','Vui lòng thử lại');
        }
        
    }
    function destroy(String $id){
        try {
            $item = $this->productService->destroy($id);
            return redirect()->route('admin.products.index')->with('success','Xóa sản phẩm thành công');
        } catch (Exception $e) {
            Log::error('Bug error : '.$e->getMessage());
            return redirect()->route('admin.products.create')->with('error','Vui lòng thử lại');
        }
        
    }
}