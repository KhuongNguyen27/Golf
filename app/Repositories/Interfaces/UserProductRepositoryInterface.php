<?php
namespace App\Repositories\Interfaces;
//RepositoryInterface cùng cấp, ko cần use
interface UserProductRepositoryInterface extends RepositoryInterface{
    public function show($package_id, $user_id);
}