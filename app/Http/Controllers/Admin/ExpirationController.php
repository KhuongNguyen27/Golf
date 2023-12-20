<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Repositories\Eloquents\ExpirationRepository;
use App\Repositories\Eloquents\PackageUserRepository;
use App\Http\Requests\StoreExpirationRequest;
use App\Http\Requests\UpdateExpirationRequest;

class ExpirationController extends AdminController
{
    protected $expirationService;
    protected $packageuserService;
    public function __construct(ExpirationRepository $expirationService, PackageUserRepository $packageuserService)
    {
        $this->expirationService = $expirationService;
        $this->packageuserService = $packageuserService;
    }
    function create(Request $request){
        try {
            $item = $this->packageuserService->find($request->id);
            $param = [
                'item' => $item
            ];
            return view('admin.packages.expiration.create',$param);
        } catch (Exception $e) {
            Log::error("Bug error : ".$e->getMessage());
            return back()->with('error','Vui lòng thử lại');
        }
    }
    function store(StoreExpirationRequest $request){
        try {
            $data = $request->except('_method','_token');
            $item = $this->packageuserService->find($data['packageuser_id']);
            $package_id = $item->package_id;
            $this->expirationService->create($data);
            return redirect()->route('admin.packages.show', $item->package_id)->with('success','Gia hạn thành công');
        } catch (Exception $e) {
            Log::error("Bug error : ".$e->getMessage());
            return back()->with('error','Vui lòng thử lại');
        }
    }
    function show(Request $request){
        $items = $this->expirationService->findUser($request->packageuser_id);
        $item = $this->packageuserService->find($request->packageuser_id);
        $param = [
            'items' => $items,
            'item' => $item
        ];
        return view('admin.packages.expiration',$param);
    }
    function edit($id){
        try {
            $item = $this->expirationService->find($id);
            $param = [
                'item' => $item,
            ];
            return view('admin.packages.expiration.edit',$param);
        } catch (Exception $e) {
            Log::error("Bug error : ".$e->getMessage());
            return back()->with('error','Vui lòng thử lại');
        }
    }
    function update(UpdateExpirationRequest $request,$id){
        try {
            $data = $request->except('_method','_token');
            $item = $this->expirationService->find($id);
            $packageuser_id = $item->packageuser_id;
            $this->expirationService->update($data,$id);
            return redirect()->route('admin.expirations.show', $packageuser_id)->with('success','Gia hạn thành công');
        } catch (Exception $e) {
            Log::error("Bug error : ".$e->getMessage());
            return back()->with('error','Vui lòng thử lại');
        }
    }
    function destroy($id){
        try {
            $item = $this->expirationService->destroy($id);
            return back()->with('success','Xóa gia hạn thành công');
        } catch (\Exception $e) {
            Log::error("Bug error : ".$e->getMessage());
            return back()->with('error','Vui lòng thử lại');
        }
    }
}