@extends('admin.layouts.master')
@section('content')
<header class="page-title-bar">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active">
                <a href="{{ route('admin.packages.show',$package_id) }}"><i
                        class="breadcrumb-icon bx bx-arrow-back mr-2"></i>Quay
                    Lại</a>
            </li>
        </ol>
    </nav>
    <h1 class="page-title">Thêm Chi Tiết</h1>
</header>
<div class="page-section">
    <div class="card card-fluid">
        <div class="card-header">
            <ul class="nav nav-tabs card-header-tabs">
                <li class="nav-item">
                    <a class="nav-link active " href="">Ngoài
                        Trời</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link"
                        href="{{ route('admin.userproducts.create3d',['user_id' => $id, 'package_id' => $package_id ]) }}">3D</a>
                </li>
            </ul>
        </div>
        <form method="post" action="{{ route('admin.userproducts.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <input type="hidden" name="user_id" value="{{$id}}">
                <input type="hidden" name="package_id" value="{{$package_id}}">
                <input type="hidden" name="is_3d" value="false">
                <div class="form-group">
                    <label for="tf1">Số lượng bóng<abbr name="Trường bắt buộc">*</abbr></label> <input name="balls"
                        type="number" value="{{ old('balls') }}" class="form-control" id=""
                        placeholder="Nhập số lượng bóng">
                    <small id="" class="form-text text-muted"></small>
                    @error('balls')
                    <input class='form-control' style="color:red" value="{{ $message }}">
                    @enderror
                </div>
                <div class="float-right mt-2">
                    <button type="submit" class="btn btn-primary">Hoàn Thành</button>
                </div>
        </form>
    </div>
</div>
@endsection