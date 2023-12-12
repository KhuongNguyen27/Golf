<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Repositories\Eloquents\OrderRepository;
use App\Repositories\Eloquents\UserRepository;
use Illuminate\Support\Facades\Auth;

class OrderController extends AdminController
{
    protected $orderService;
    protected $userService;
    public function __construct(OrderRepository $orderService,UserRepository $userService)
    {
        $this->orderService = $orderService;
        $this->userService = $userService;
    }   
    public function index(Request $request)
    {
        $items = $this->orderService->all();
        $param =
        [
            'items' => $items,
        ];
        return view('admin.orders.index', $param);
    }
    function create(){
        $users = $this->userService->all();
        $param = [
            'users' => $users
        ];
        return view('admin.orders.create',$param);
    }
    function store(StoreOrderRequest $request){
        try {
            $data = $request->except('_method','_token');
            $item = $this->orderService->store($data);
            return redirect()->route('admin.orders.index')->with('success','Thêm đơn hàng thành công');
        } catch (Exception $e) {
            Log::error('Bug error : '.$e->getMessage());
            return redirect()->route('admin.orders.create')->with('error','Vui lòng thử lại');
        }
        
    }
    function edit(String $id){
        $item = $this->orderService->find($id);
        $users = $this->userService->all();
        $param = [
            'item' => $item,
            'users' => $users,
        ];
        return view('admin.orders.edit',$param);
    }
    function update(UpdateOrderRequest $request,String $id){
        try {
            $data = $request->except('_method','_token');
            $item = $this->orderService->update($data,$id);
            return redirect()->route('admin.orders.index')->with('success','Cập nhập đơn hàng thành công');
        } catch (Exception $e) {
            Log::error('Bug error : '.$e->getMessage());
            return redirect()->route('admin.orders.create')->with('error','Vui lòng thử lại');
        }
        
    }
    function destroy(String $id){
        try {
            $item = $this->orderService->destroy($id);
            return redirect()->route('admin.orders.index')->with('success','Xóa đơn hàng thành công');
        } catch (Exception $e) {
            Log::error('Bug error : '.$e->getMessage());
            return redirect()->route('admin.orders.create')->with('error','Vui lòng thử lại');
        }
        
    }
}