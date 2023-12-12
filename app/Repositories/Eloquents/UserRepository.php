<?php
namespace App\Repositories\Eloquents;

use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Repositories\Eloquents\EloquentRepository;
use App\Models\User;
use Illuminate\Http\Request;

class UserRepository extends EloquentRepository implements UserRepositoryInterface
{
    public function getModel()
    {
        return User::class;
    }
}