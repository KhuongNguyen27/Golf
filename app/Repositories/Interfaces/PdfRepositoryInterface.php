<?php
namespace App\Repositories\Interfaces;
//RepositoryInterface cùng cấp, ko cần use
interface PdfRepositoryInterface extends RepositoryInterface{
    function create_pdf($id);
}