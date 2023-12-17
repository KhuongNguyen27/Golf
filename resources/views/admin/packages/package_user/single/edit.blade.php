@extends('admin.layouts.master')
@section('content')
<header class="page-title-bar">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active">
                <a href="{{ route('admin.userproducts.showuser',[$item->user_id,$item->package_id]) }}"><i
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
            </ul>
        </div>
        <form method="post" action="{{ route('admin.userproducts.update',$item->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card-body">
                <input type="hidden" name="is_3d" value="false">
                <div class="form-group">
                    <label for="tf1">Số lượng bóng<abbr name="Trường bắt buộc">*</abbr></label> <input name="balls"
                        type="number" value="{{ old('balls')? old('balls') : $item->balls }}" class="form-control" id=""
                        placeholder="Nhập số lượng bóng">
                    <small id="" class="form-text text-muted"></small>
                    @error('balls')
                    <input class='form-control' style="color:red" value="{{ $message }}">
                    @enderror
                </div>
                <div class="form-group">
                    <label for="tf1">Ngày sử dụng<abbr name="Trường bắt buộc">*</abbr></label> <input name="created_at"
                        type="date" value="{{ old('created_at')? old('created_at') : $item->created_at }}"
                        class="form-control" id="" placeholder="Nhập ngày sử dụng">
                    <small id="" class="form-text text-muted"></small>
                    @error('created_at')
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