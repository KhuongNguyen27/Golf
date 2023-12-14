<?php
namespace App\Repositories\Eloquents;

use App\Repositories\Interfaces\UserProductRepositoryInterface;
use App\Repositories\Eloquents\EloquentRepository;
use App\Models\UserProduct;
use App\Models\PackageUser;
use Illuminate\Http\Request;

class UserProductRepository extends EloquentRepository implements UserProductRepositoryInterface
{
    public function getModel()
    {
        return UserProduct::class;
    }
    public function store($data){
        if (!isset($data['is_3d']) || $data['is_3d'] === 'false') {
            $item = PackageUser::where('package_id',$data['package_id'])->where('user_id',$data['user_id'])->first();
            if ($item->used_numbers === null) {
                $item->used_numbers = 1;
            } else {
                $item->used_numbers += 1;
            }
            $item->save();
            return $this->model->create($data);
        }else{
            $data['total_hour'] = $data['to_hour']-$data['hour_to'];
            $item = PackageUser::where('package_id',$data['package_id'])->where('user_id',$data['user_id'])->first();
            if ($item->total_hour === null) {
                $item->total_hour = $data['total_hour'];
            } else {
                $item->total_hour += $data['total_hour'];
            }
            $item->used_numbers += 1;
            $item->save();
            return $this->model->create($data);
        }
    }
    public function show($package_id, $user_id){
        return $this->model->where('package_id', $package_id)->where('user_id', $user_id)->with('user')->get();
    }
    function destroy($id){
        $item = $this->model->findOrFail($id);
        $user_package = PackageUser::where('user_id',$item->user_id)->where('package_id',$item->package_id)->first();
        $user_package->used_numbers -= 1;
        $user_package->total_hour -= $item->total_hour;
        $user_package->save();
        return $this->model->findOrFail($id)->delete();
    }
}