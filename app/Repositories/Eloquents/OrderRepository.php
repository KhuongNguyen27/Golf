<?php
namespace App\Repositories\Eloquents;

use App\Repositories\Interfaces\OrderRepositoryInterface;
use App\Repositories\Eloquents\EloquentRepository;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Carbon\Carbon;

class OrderRepository extends EloquentRepository implements OrderRepositoryInterface
{
    public function getModel()
    {
        return Order::class;
    }
    public function all()
    {
        $result = $this->model->with('user')->get();
        return $result;
    }
    function show($id){
        $result = $this->model->with('orderdetail')->find($id);
        return $result;
    }
    function store($data)
    {
        try {
            // Thêm mới order
            $dataUser = [
                'user_id' => $data['user_id'],
                'note' => $data['note']
            ];
            $order = $this->model->create($dataUser);
            // Thêm mới orderdetail
            $data['order_id'] = $order->id;
            $product = Product::findOrfail($data['product_id']);
            $data['total'] = $product->price * $data['quantity'];
            $detail = OrderDetail::create($data);
            return $order;
        } catch (Exception $e) {
            Log::error('Bug error : '.$e->getMessage());
            return redirect()->route('admin.orders.index',$id)->with('error','Thêm hóa đơn thất bại');
        }
        
    }
}