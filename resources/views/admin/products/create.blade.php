@extends('admin.layouts.master')
@section('content')
<header class="page-title-bar">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active">
                <a href="{{ URL::previous() }}"><i class="breadcrumb-icon bx bx-arrow-back mr-2"></i>Quay Lại </a>
            </li>
        </ol>
    </nav>
    <h1 class="page-title">Thêm Sản Phẩm</h1>
</header>
<div class="page-section">
    <form method="post" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="card">
            <div class="card-body">
                <legend>Thông tin cơ bản</legend>
                <div class="form-group">
                    <label for="tf1">Tên Sản Phẩm <abbr name="Trường bắt buộc">*</abbr></label> <input name="name"
                        type="text" value="{{ old('name') }}" class="form-control" id=""
                        placeholder="Nhập tên sản phẩm">
                    <small id="" class="form-text text-muted"></small>
                    @error('name')
                    <input class='form-control' style="color:red" value="{{ $message }}">
                    @enderror
                </div>
                <!-- <div class="form-group">
                    <label for="tf1">Số lượng nhập <abbr name="Trường bắt buộc">*</abbr></label> <input name="quantity"
                        type="text" value="{{ old('quantity') }}" class="form-control" id=""
                        placeholder="Nhập tên sản phẩm">
                    <small id="" class="form-text text-muted"></small>
                    @error('quantity')
                    <input class='form-control' style="color:red" value="{{ $message }}">
                    @enderror
                </div> -->
                <div class="form-group">
                    <label for="tf1">Giá tiền (VND) <abbr name="Trường bắt buộc">*</abbr></label> <input name="price"
                        type="text" value="{{ old('price') }}" class="form-control" id=""
                        placeholder="Nhập tên sản phẩm">
                    <small id="" class="form-text text-muted"></small>
                    @error('price')
                    <input class='form-control' style="color:red" value="{{ $message }}">
                    @enderror
                </div>
                <div class="form-group">
                    <label for="tf1">Trạng thái <abbr name="Trường bắt buộc">*</abbr></label>
                    <select name="status" class="form-control">
                        <option value="">Chọn trạng thái...</option>
                        <option value="1">Hoạt động</option>
                        <option value="0">Tạm dừng</option>
                    </select>
                    <small id="" class="form-text text-muted"></small>
                    @error('status')
                    <input class='form-control' style="color:red" value="{{ $message }}">
                    @enderror
                </div>
                <div class="form-actions">
                    <a class="btn btn-secondary float-right" href="{{ route('admin.users.index') }}">Hủy</a>
                    <button class="btn btn-primary ml-auto" type="submit">Lưu</button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
@section('footer')

@endsection