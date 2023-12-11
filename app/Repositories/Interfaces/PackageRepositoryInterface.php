<?php
namespace App\Repositories\Interfaces;
//RepositoryInterface cùng cấp, ko cần use
interface PackageRepositoryInterface extends RepositoryInterface{
    public function show($id);
}