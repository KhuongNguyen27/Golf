<?php
namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Repositories\Eloquents\UserRepository;
use Illuminate\Support\Facades\Auth;
use App\Traits\UploadFileTrait;
use Illuminate\Support\Str;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Log;

class UserController extends AdminController
{
    use UploadFileTrait;
    protected $userService;
    public function __construct(UserRepository $userService)
    {
        $this->userService = $userService;
    }   
    public function index(Request $request)
    {
            $items = $this->userService->all();
            $param =
            [
                'items' => $items,
            ];
        return view('admin.members.index', $param);
    }
    function create(){
        return view('admin.members.create');
    }
    function store(StoreUserRequest $request){
        try {
            $data = $request->except(['_method','_token']);
            $code = 'L'.rand(1,100);
            if ($request->hasFile('avatar')) {
                $data['avatar'] = $this->uploadFile($request->file('avatar'), 'uploads/'.$code.'/users');
            }else {
                $data['avatar'] = 'admin/assets/defaul.png';
            }
            $item = $this->userService->store($data);
            return redirect()->route('admin.users.index')->with('success','Thêm thành công');
        } catch (Exception $e) {
            Log::error('Bug error : '.$e->getMessage());
            return redirect()->route('admin.users.index')->with('error','Thêm thất bại');
        }
    }
    function edit(String $id){
        $item = $this->userService->find($id);
        $param = [
            'item' => $item
        ];
        return view('admin.members.edit',$param);
    }
    function update(UpdateUserRequest $request,String $id){
        try {
            $user = $this->userService->find($id);
            $data = $request->except(['_method','_token']);
            if ($request->hasFile('avatar')) {
                $data['avatar'] = $this->uploadFile($request->file('avatar'), 'uploads/'.$user->code.'/users');
            }
            $item = $this->userService->update($data,$id);
            return redirect()->route('admin.users.index')->with('success','Cập nhập thành công');
        } catch (Exception $e) {
            Log::error('Bug error : '.$e->getMessage());
            return redirect()->route('admin.users.index')->with('error','Cập nhập thất bại');
        }
    }
    function destroy($id){
        try {
            $item = $this->userService->destroy($id);
            return redirect()->route('admin.users.index')->with('success','Xóa thành công');
        } catch (Exception $e) {
            Log::error('Bug error : '.$e->getMessage());
            return redirect()->route('admin.users.index')->with('error','Xóa thất bại');
        }
    }
}