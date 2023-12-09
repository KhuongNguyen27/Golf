<?php
namespace App\Repositories\Interfaces;

interface RepositoryInterface {
    public function all();
    public function paginate($limit);
    public function show($id);
    public function store($request);
    public function update($request, $id);
    public function destroy($id);
}