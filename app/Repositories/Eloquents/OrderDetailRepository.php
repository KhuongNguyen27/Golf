<?php
namespace App\Repositories\Eloquents;

use App\Repositories\Interfaces\OrderDetailRepositoryInterface;
use App\Repositories\Eloquents\EloquentRepository;
use App\Models\OrderDetail;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Carbon\Carbon;

class OrderDetailRepository extends EloquentRepository implements OrderDetailRepositoryInterface
{
    public function getModel()
    {
        return OrderDetail::class;
    }
    function find($id){
        return $this->model->with('order')->find($id);
    }

    function store($data){
        try {
            $order_id = $data['order_id'];
            $product_id = $data['product_id'];
            $quantity = $data['quantity'];
            $product = Product::findOrfail($product_id);
            $total = $quantity*$product->price;
            $data['total'] = $total;
            $result = $this->model->create($data);

            // Change total order
            if ($result) {
                $order = Order::findOrfail($order_id);
                $orderdetails = $this->model->where('order_id',$order_id)->get();
                $totalDetail = 0;
                foreach ($orderdetails as $orderdetail) {
                    $totalDetail += $orderdetail->total;
                }
                $order->total = $totalDetail;
                $order->save();
            }
            return $result;
        } catch (Exception $e) {
            Log::error('Bug error : '.$e->getMessage());
            return redirect()->route('admin.orderdetails.create')->with('error','Thêm sản phẩm thất bại');
        }
    }
    function update($data,$id){
        try {
            $orderdetail = $this->model->find($id);
            $quantity = $data['quantity'];
            $product = Product::findOrfail($orderdetail->product_id);
            $total = $quantity*$product->price;
            $data['order_id'] = $orderdetail->order_id;
            $data['product_id'] = $orderdetail->product_id;
            $data['total'] = $total;
            $result = $this->model->findOrFail($id)->update($data);
            // Change total order
            if ($result) {
                $order = Order::findOrfail($orderdetail->order_id);
                $orderdetails = $this->model->where('order_id',$orderdetail->order_id)->get();
                $totalDetail = 0;
                foreach ($orderdetails as $orderdetail) {
                    $totalDetail += $orderdetail->total;
                }
                $order->total = $totalDetail;
                $order->save();
                return $result;
            }
            return redirect()->route('admin.orderdetails.update',$id)->with('error','Cập nhập sản phẩm thất bại');
        } catch (Exception $e) {
            Log::error('Bug error : '.$e->getMessage());
            return redirect()->route('admin.orderdetails.update',$id)->with('error','Cập nhập sản phẩm thất bại');
        }
    }
}