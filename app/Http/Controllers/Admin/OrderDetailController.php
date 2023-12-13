<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreOrderDetailRequest;
use App\Http\Requests\UpdateOrderDetailRequest;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Support\Facades\DB;
use App\Repositories\Eloquents\OrderDetailRepository;
use App\Repositories\Eloquents\ProductRepository;
use App\Repositories\Eloquents\OrderRepository;
use Illuminate\Support\Facades\Auth;

class OrderDetailController extends AdminController
{
    protected $orderdetailService;
    protected $productService;
    protected $orderService;
    public function __construct(OrderDetailRepository $orderdetailService,ProductRepository $productService,OrderRepository $orderService)
    {
        $this->orderdetailService = $orderdetailService;
        $this->productService = $productService;
        $this->orderService = $orderService;
    }   
    public function index(Request $request)
    {
        $items = $this->orderdetailService->all();
        $param =
        [
            'items' => $items,
        ];
        return view('admin.orderdetails.index', $param);
    }
    function create(Request $request){
        $order_id = $request->order_id;
        $products = $this->productService->all();
        $param = [
            'products' => $products,
            'order_id' => $order_id
        ];
        return view('admin.orderdetails.create',$param);
    }
    function store(StoreOrderDetailRequest $request){
        try {
            $data = $request->except('_method','_token');
            $item = $this->orderdetailService->store($data);
            return redirect()->route('admin.orders.index')->with('success','Thêm đơn hàng thành công');
        } catch (Exception $e) {
            Log::error('Bug error : '.$e->getMessage());
            return redirect()->route('admin.orderdetails.create')->with('error','Vui lòng thử lại');
        }
        
    }
    function edit(String $id){
        $item = $this->orderdetailService->find($id);
        $param = [
            'item' => $item,
        ];
        return view('admin.orderdetails.edit',$param);
    }
    function update(UpdateOrderDetailRequest $request,String $id){
        try {
            $data = $request->except('_method','_token');
            $orderdetail = $this->orderdetailService->find($id);
            $order_id = $orderdetail->order->id;
            $item = $this->orderdetailService->update($data,$id);
            return redirect()->route('admin.orders  .show',$order_id)->with('success','Cập nhập đơn hàng thành công');
        } catch (Exception $e) {
            Log::error('Bug error : '.$e->getMessage());
            return redirect()->route('admin.orderdetails.create')->with('error','Vui lòng thử lại');
        }
        
    }
    function destroy(String $id){
        try {
            $item = $this->orderdetailService->destroy($id);
            return redirect()->route('admin.orderdetails.index')->with('success','Xóa đơn hàng thành công');
        } catch (Exception $e) {
            Log::error('Bug error : '.$e->getMessage());
            return redirect()->route('admin.orderdetails.create')->with('error','Vui lòng thử lại');
        }
        
    }
}