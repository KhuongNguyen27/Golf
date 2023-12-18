<?php
namespace App\Repositories\Interfaces;
//RepositoryInterface cùng cấp, ko cần use
interface ExpirationRepositoryInterface extends RepositoryInterface{
    function findUser($packageuser_id);
}