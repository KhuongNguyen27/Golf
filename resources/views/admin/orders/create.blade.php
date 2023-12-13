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
    <h1 class="page-title">Thêm Đơn Hàng</h1>
</header>
<div class="page-section">
    <form method="post" action="{{ route('admin.orders.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="card">
            <div class="card-body">
                <legend>Thông tin cơ bản</legend>
                <div class="form-group">
                    <label for="tf1">Tên Thành Viên <abbr name="Trường bắt buộc">*</abbr></label>
                    <select name="user_id" class="form-control mt-2">
                        <option value="">Chọn khách hàng...</option>
                        @foreach($users as $user)
                        <option value="{{ $user->id }}" {{ (old('user_id') == $user->id) ? 'selected' : '' }}>
                            {{ $user->name }}
                        </option>
                        @endforeach
                    </select>
                    <small id="" class="form-text text-muted"></small>
                    @error('user_id')
                    <input class='form-control' style="color:red" value="{{ $message }}">
                    @enderror
                </div>
                <div class="form-group">
                    <label for="tf1">Tên sản phẩm <abbr name="Trường bắt buộc">*</abbr></label>
                    <select name="product_id" class="form-control mt-2">
                        <option value="">Chọn sản phẩm...</option>
                        @foreach($products as $product)
                        <option value="{{ $product->id }}" {{ (old('product_id') == $product->id) ? 'selected' : '' }}>
                            {{ $product->name }}
                        </option>
                        @endforeach
                    </select>
                    <small id="" class="form-text text-muted"></small>
                    @error('product_id')
                    <input class='form-control' style="color:red" value="{{ $message }}">
                    @enderror
                </div>
                <div class="form-group">
                    <label for="tf1">Số lượng</label>
                    <input type="number" name="quantity" class="form-control"
                        value="{{ old('quantity') ? old('quantity') : 1  }}">
                    <small id="" class="form-text text-muted"></small>
                    @error('quantity')
                    <input class='form-control' style="color:red" value="{{ $message }}">
                    @enderror
                </div>
                <div class="form-group">
                    <label for="tf1">Ghi chú</label>
                    <textarea name="note" class="form-control">{{old('notes')}}</textarea>
                    <small id="" class="form-text text-muted"></small>
                </div>

                <div class="form-actions">
                    <a class="btn btn-secondary float-right" href="{{ route('admin.orders.index') }}">Hủy</a>
                    <button class="btn btn-primary ml-auto" type="submit">Lưu</button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
@section('footer')

@endsection