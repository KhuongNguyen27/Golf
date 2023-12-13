<?php
namespace App\Repositories\Eloquents;

use App\Repositories\Interfaces\UserProductRepositoryInterface;
use App\Repositories\Eloquents\EloquentRepository;
use App\Models\UserProduct;
use Illuminate\Http\Request;

class UserProductRepository extends EloquentRepository implements UserProductRepositoryInterface
{
    public function getModel()
    {
        return UserProduct::class;
    }
    public function store35($data){
        $data['hour_to_hour'] = $data['hour_to'].'h - '.$data['to_hour'].'h';
        $data['hour_on_day'] = $data['to_hour']-$data['hour_to'];
        return $this->model->create($data);
    }
    public function show($package_id, $user_id){
        return $this->model->where('package_id', $package_id)->where('user_id', $user_id)->with('user')->get();
    }
}