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
    <h1 class="page-title">Cập Nhập Thành Viên</h1>
</header>
<div class="page-section">
    <form method="post" action="{{ route('admin.products.update',$item->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="card">
            <div class="card-body">
                <legend>Thông tin cơ bản</legend>
                <div class="form-group">
                    <label for="tf1">Tên Sản Phẩm <abbr name="Trường bắt buộc">*</abbr></label> <input name="name"
                        type="text" value="{{ old('name')? old('name') : $item->name }}" class="form-control" id=""
                        placeholder="Nhập tên sản phẩm">
                    <small id="" class="form-text text-muted"></small>
                    @error('name')
                    <input class='form-control' style="color:red" value="{{ $message }}">
                    @enderror
                </div>
                <!-- <div class="form-group">
                    <label for="tf1">Số Lượng<abbr name="Trường bắt buộc">*</abbr></label> <input name="quantity"
                        type="number" value="{{ old('quantity')? old('quantity') : $item->quantity }}"
                        class="form-control" id="" placeholder="Nhập số lượng">
                    <small id="" class="form-text text-muted"></small>
                    @error('quantity')
                    <input class='form-control' style="color:red" value="{{ $message }}">
                    @enderror
                </div> -->
                <div class="form-group">
                    <label for="tf1">Giảm Giá</label>
                    <input name="discount" type="number"
                        value="{{ old('discount')? old('discount') : $item->discount }}" class="form-control" id=""
                        placeholder="Nhập giá sau khi giảm">
                    <small id="" class="form-text text-muted"></small>
                    @error('discount')
                    <input class='form-control' style="color:red" value="{{ $message }}">
                    @enderror
                </div>
                <div class="form-group">
                    <label for="tf1">Giá tiền</label>
                    <input name="price" type="number" value="{{ old('price')? old('price') : $item->price }}"
                        class="form-control" id="" placeholder="Nhập giá tiền">
                    <small id="" class="form-text text-muted"></small>
                    @error('price')
                    <input class='form-control' style="color:red" value="{{ $message }}">
                    @enderror
                </div>
                <div class="form-group">
                    <label for="tf1">Trạng Thái</label>
                    <select name="status" class="form-control">
                        <option value="">Chọn trạng thái...</option>
                        <option value="1" {{ ($item->status == 1) ? 'selected' : '' }}>Hoạt động</option>
                        <option value="0" {{ ($item->status == 0) ? 'selected' : '' }}>Tạm dừng</option>
                    </select>
                    <small id="" class="form-text text-muted"></small>
                    @error('status')
                    <input class='form-control' style="color:red" value="{{ $message }}">
                    @enderror
                </div>
                <div class="form-actions">
                    <a class="btn btn-secondary float-right" href="{{ route('admin.products.index') }}">Hủy</a>
                    <button class="btn btn-primary ml-auto" type="submit">Lưu</button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection