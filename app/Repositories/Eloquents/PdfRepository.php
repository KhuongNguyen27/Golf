<?php
namespace App\Repositories\Eloquents;

use App\Repositories\Interfaces\PdfRepositoryInterface;
use App\Repositories\Eloquents\EloquentRepository;
use App\Models\UserProduct;
use App\Models\PackageUser;
use Illuminate\Http\Request;
use PDF;
use Redirect;

class PdfRepository extends EloquentRepository implements PdfRepositoryInterface
{
    public function getModel()
    {
        return UserProduct::class;
    }
    public function create_pdf($id){
        $package_user = PackageUser::with('user','expiration')->withCount('expiration')->find($id);
        $items = $this->model->where('package_id',$package_user->package_id)->where('user_id',$package_user->user_id)->get();
        $param = [
            'package_user' => $package_user,
            'items' => $items,
        ];
        $pdf = PDF::loadView('admin.packages.pdf.invoice',$param);
        return $pdf->download('historyUserused.pdf');        
    }
}