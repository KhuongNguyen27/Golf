<?php
namespace App\Repositories\Eloquents;

use App\Repositories\Interfaces\ProductRepositoryInterface;
use App\Repositories\Eloquents\EloquentRepository;
use App\Models\Product;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ProductRepository extends EloquentRepository implements ProductRepositoryInterface
{
    public function getModel()
    {
        return Product::class;
    }
}