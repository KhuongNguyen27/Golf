<?php
namespace App\Repositories\Eloquents;

use App\Repositories\Interfaces\PackageRepositoryInterface;
use App\Repositories\Eloquents\EloquentRepository;
use App\Models\Package;
use App\Models\PackageUser;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PackageRepository extends EloquentRepository implements PackageRepositoryInterface
{
    public function getModel()
    {
        return Package::class;
    }
    public function all()
    {
        $result = $this->model->with('duration')->get();
        return $result;
    }
    public function show($id)
    {
        $result = PackageUser::where('package_id',$id)->with('package','user','rank')->get();
        return $result;
    }
    public function store($data)
    {
        try {
            $package = Package::with('duration')->findOrfail($data['package_id']);
            $result = new PackageUser();
            $result->package_id = $data['package_id'];
            $result->register_day = date("Y-m-d");
            $result->activity_day = date("Y-m-d");
            $result->expiration_date = Carbon::today()->addDays(intval($package->duration_amount))->format("Y-m-d");
            $result->user_id = $data['user_id'];
            $result->rank_id = 1;
            $result->status  = 1;
            $result->save();
            return $result;
        } catch (Exception $e) {
            Log::error('Bug error : '.$e->getMessage());
            return back()->with('error','Thêm gói thất bại');
        }
    }
}