<?php
namespace App\Repositories\Eloquents;

use App\Repositories\Interfaces\OrderRepositoryInterface;
use App\Repositories\Eloquents\EloquentRepository;
use App\Models\Order;
use App\Models\OrderUser;
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
}