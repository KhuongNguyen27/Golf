@extends('admin.layouts.master')
@section('content')
<header class="page-title-bar">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active">
                <a href="{{ route('admin.userproducts.showuser',[$item->user_id,$item->package_id]) }}"><i class="breadcrumb-icon bx bx-arrow-back mr-2"></i>Quay Lại</a>
            </li>
        </ol>
    </nav>
    <h1 class="page-title">Cập Nhập Thành Viên</h1>
</header>
<div class="page-section">
    <form method="post" action="{{ route('admin.userproducts.update',$item->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="card">
            <div class="card-body">
                <legend>Thông tin cơ bản</legend>
                <div class="form-group">
                    <label for="tf1">Số lượng bóng <abbr name="Trường bắt buộc">*</abbr></label> <input name="balls"
                        type="number" value="{{ old('balls')? old('balls') : $item->balls }}" class="form-control" id=""
                        placeholder="Nhập Số lượng bóng">
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
                <div class="form-actions">
                    <a class="btn btn-secondary float-right" href="{{ url()->previous() }}">Hủy</a>
                    <button class="btn btn-primary ml-auto" type="submit">Lưu</button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection