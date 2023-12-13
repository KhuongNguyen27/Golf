<?php
namespace App\Repositories\Interfaces;
//RepositoryInterface cùng cấp, ko cần use
interface OrderRepositoryInterface extends RepositoryInterface{
    public function show($id);
}