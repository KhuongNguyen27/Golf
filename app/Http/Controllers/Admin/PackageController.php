<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Repositories\Eloquents\PackageRepository;

class PackageController extends AdminController
{
    protected $packageService;
    protected $route_prefix = 'admin.packages.';
    public function __construct(PackageRepository $packageService)
    {
        $this->packageService = $packageService;
    }   
    public function index(Request $request)
    {
        $items = $this->packageService->all();
        $param =
        [
            'items' => $items,
        ];
        return view($this->route_prefix.'index', $param);
    }
}