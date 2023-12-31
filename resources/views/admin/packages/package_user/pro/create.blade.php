@extends('admin.layouts.master')
@section('content')
<header class="page-title-bar">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active">
                <a href="{{ route('admin.packages.show',$package_id) }}"><i
                        class="breadcrumb-icon bx bx-arrow-back mr-2"></i>Quay Lại</a>
            </li>
        </ol>
    </nav>
    <h1 class="page-title">Thêm Chi Tiết</h1>
</header>
<div class="page-section">
    <form method="post" action="{{ route('admin.userproducts.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="card">
            <div class="card-body">
                <legend>Thông tin cơ bản</legend>
                <input type="hidden" name="user_id" value="{{$id}}">
                <input type="hidden" name="package_id" value="{{$package_id}}">
                <div class="form-group">
                    <label for="tf1">Số lượng bóng<abbr name="Trường bắt buộc">*</abbr></label> <input name="balls"
                        type="number" value="{{ old('balls') }}" class="form-control" id=""
                        placeholder="Nhập số lượng bóng">
                    <small id="" class="form-text text-muted"></small>
                    @error('balls')
                    <input class='form-control' style="color:red" value="{{ $message }}">
                    @enderror
                </div>
                <div class="form-group">
                    <label for="tf1">Ngày sử dụng<abbr name="Trường bắt buộc">*</abbr></label> <input name="created_at"
                        type="date" value="{{ old('created_at') }}" class="form-control" id=""
                        placeholder="Nhập ngày sử dụng">
                    <small id="" class="form-text text-muted"></small>
                    @error('created_at')
                    <input class='form-control' style="color:red" value="{{ $message }}">
                    @enderror
                </div>
                <div class="float-right mt-2">
                    <button type="submit" class="btn btn-primary">Hoàn Thành</button>
                </div>
            </div>
    </form>
</div>
@endsection