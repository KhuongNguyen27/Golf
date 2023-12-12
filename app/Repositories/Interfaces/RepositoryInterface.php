<?php
namespace App\Repositories\Interfaces;

interface RepositoryInterface {
    public function all();
    public function paginate($limit);
    public function find($id);
    public function store($request);
    public function update($request, $id);
    public function destroy($id);
}