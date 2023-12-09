<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Services\Interfaces\UserServiceInterface;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    protected $userService;
    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }
    public function index(Request $request)
    {
        $this->authorize('viewAny', User::class);
        $items = $this->userService->all();
        $param =
            [
                'items' => $items,
            ];
        return view('users.index', $param);
    }
}