<?php
namespace App\Repositories\Eloquents;

use Illuminate\Http\Request;

use App\Repositories\Interfaces\PackageUserRepositoryInterface;
use App\Repositories\Eloquents\EloquentRepository;
use App\Models\PackageUser;
use App\Models\Package;

use Carbon\Carbon;
use DateTime;
use DateInterval;

class PackageUserRepository extends EloquentRepository implements PackageUserRepositoryInterface
{
    public function getModel()
    {
        return PackageUser::class;
    }
    function all($request = null){
        $package_id = $request->package_id;
        $result = $this->model::where('package_id',$package_id)->withCount('expiration')->get();
        return $result;
    }
    public function store($data)
    {
        try {
            $package = Package::findOrfail($data['package_id']);
            $result = $this->model::where('user_id',$data['user_id'])->where('package_id',$data['package_id'])->first();
            if ($result) {
                $expirationDate = DateTime::createFromFormat('Y-m-d', $result->expiration_date);
                $expirationDate->add(new DateInterval('P30D'));
                $result->expiration_date = $expirationDate->format('Y-m-d');
                $result->save();
            }else {
                $item = [];
                $item['package_id'] = $data['package_id'];
                $item['user_id'] = $data['user_id'];
                $item['used_numbers'] = 0;
                $item['register_day'] = date("Y-m-d");
                $item['activity_day'] = date("Y-m-d");
                $item['expiration_date'] = Carbon::today()->addDays(intval($package->duration_amount))->format("Y-m-d");
                $item['rank_id'] = 1;
                $item['status']  = 1;
                $this->model::create($item);
            }
            return $result;
        } catch (Exception $e) {
            Log::error('Bug error : '.$e->getMessage());
            return back()->with('error','Thêm gói thất bại');
        }
    }
    function destroy($id){
        try {
            $item = $this->model::findOrfail($id);
            $item->deleteExpiration($id);
            $item->deleteUserProduct($id);
            $item->delete();
            return back()->with('error','Xóa thành viên thành công');
        } catch (Exception $e) {
            Log::error('Bug error : '.$e->getMessage());
            return back()->with('error','Xóa thành viên thất bại');
        }
    }
}