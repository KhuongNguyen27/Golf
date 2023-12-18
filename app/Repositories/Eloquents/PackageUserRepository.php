<?php
namespace App\Repositories\Eloquents;

use App\Repositories\Interfaces\PackageUserRepositoryInterface;
use App\Repositories\Eloquents\EloquentRepository;
use App\Models\PackageUser;
use App\Models\Expiration;
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
}