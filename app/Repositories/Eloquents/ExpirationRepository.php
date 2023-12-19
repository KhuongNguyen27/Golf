<?php
namespace App\Repositories\Eloquents;

use App\Repositories\Interfaces\ExpirationRepositoryInterface;
use App\Repositories\Eloquents\EloquentRepository;
use App\Models\PackageUser;
use App\Models\Expiration;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DateTime;
use DateInterval;

class ExpirationRepository extends EloquentRepository implements ExpirationRepositoryInterface
{
    public function getModel()
    {
        return Expiration::class;
    }
    function create($data){
        $packages = PackageUser::find($data['packageuser_id']);
        $expirationDate = DateTime::createFromFormat('Y-m-d', $packages->expiration_date);
        $expirationDate->add(new DateInterval('P1D'));
        $packages->expiration_date = $expirationDate->format('Y-m-d');
        $packages->save();
        return $this->model->create($data);
    }
    function findUser($packageuser_id){
        return $this->model->where('packageuser_id',$packageuser_id)->orderBy('expiration_date','DESC')->get();
    }
    function find($id){
        return $this->model->with('package_user')->find($id);
    } 
}