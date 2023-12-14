<?php
namespace App\Repositories\Eloquents;

use App\Repositories\Interfaces\PackageUserRepositoryInterface;
use App\Repositories\Eloquents\EloquentRepository;
use App\Models\PackageUser;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DateTime;
use DateInterval;

class PackageUserRepository extends EloquentRepository implements PackageUserRepositoryInterface
{
    public function getModel()
    {
        return PackageUser::class;
    }
    function expiration($data){
        $result = $this->model->where('user_id',$data['user_id'])->where('package_id',$data['package_id'])->first();
        $expirationDate = DateTime::createFromFormat('Y-m-d', $result->expiration_date);
        $expirationDate->add(new DateInterval('P1D'));
        $result->expiration_date = $expirationDate->format('Y-m-d');
        $result->save();
        return $result;
    }
}