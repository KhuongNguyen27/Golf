<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Eloquents\PdfRepository;
use App\Repositories\Eloquents\PackageUserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PdfController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $pdfService;
    protected $packageuserService;
    public function __construct(PdfRepository $pdfService,PackageUserRepository $packageuserService)
    {
        $this->pdfService = $pdfService;
        $this->packageuserService = $packageuserService;
    } 
    public function create(Request $request)
    {
        try {
            $id = $request->id;
            $packageuser = $this->packageuserService->find($id);
            return $this->pdfService->create_pdf($id);
            // return redirect()->route('admin.userproducts.showuser',['user_id'=>$packageuser->user_id,'package_id'=>$packageuser->package_id])->with('success','Xuất PDF thành công');
        } catch (\Exception $e) {
            Log::error('Bug error : '.$e->getMessage());
            return redirect()->back()->with('error','Xuất PDF thất bại');
        }
    }

    /**
     * Show the form for creating a new resource.
     */

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}