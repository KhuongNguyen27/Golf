<?php
namespace App\Repositories\Eloquents;

use App\Repositories\Interfaces\PackageRepositoryInterface;
use App\Repositories\Eloquents\EloquentRepository;
use App\Models\Package;
use Illuminate\Http\Request;


class PackageRepository extends EloquentRepository implements PackageRepositoryInterface
{
    public function getModel()
    {
        return Package::class;
    }
}