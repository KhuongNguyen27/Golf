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
    public function all($request = [])
    {
        return $this->model->where('package_user_id', $request->package_user_id)->orderBy('used_day','ASC')->get();
    }
    public function store($data)
    {
        $item = $data['item'];
        if (isset($data['is_3d']) && $data['is_3d'] === 'true') {
            if ($item->total_hour === null) {
                $item->total_hour = $data['total_hour'];
            } else {
                $item->total_hour += $data['total_hour'];
            }
        }
        if ($item->used_numbers === null) {
            $item->used_numbers = 1;
        } else {
            $item->used_numbers += 1;
        }
        $item->save();
        return $this->model->create($data);
    }
    function destroy($id)
    {
        $item = $this->model->findOrFail($id);
        $user_package = PackageUser::where('user_id',$item->user_id)->where('package_id',$item->package_id)->first();
        $user_package->used_numbers -= 1;
        $user_package->total_hour -= $item->total_hour;
        $user_package->save();

        return $this->model->findOrFail($id)->delete();
    }
}