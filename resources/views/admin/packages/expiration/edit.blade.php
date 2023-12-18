@extends('admin.layouts.master')
@section('content')
<header class="page-title-bar">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active">
                <a href="{{ route('admin.packages.show', $item->package_user->package_id) }}"><i
                        class="breadcrumb-icon bx bx-arrow-back mr-2"></i>Quay Lại
                </a>
            </li>
        </ol>
    </nav>
    <h1 class="page-title">Gia hạn</h1>
</header>
<div class="page-section">
    <form method="post" action="{{ route('admin.expirations.update',$item->id) }}" enctype="multipart/form-data">
        @csrf
        @method('put')
        <div class="card">
            <div class="card-body">
                <legend>Thông tin cơ bản</legend>
                <div class="form-group">
                    <label for="tf1">Lý do gia hạn <abbr name="Trường bắt buộc">*</abbr></label>
                    <input name="description" type="text"
                        value="{{ old('description') ? old('description') : $item->description }}" class="form-control"
                        id="" placeholder="Nhập lý do gia hạn">
                    <small id="" class="form-text text-muted"></small>
                    @error('description')
                    <input class='form-control' style="color:red" value="{{ $message }}">
                    @enderror
                </div>
                <div class="form-group">
                    <label for="tf1">Ngày gia hạn <abbr name="Trường bắt buộc">*</abbr></label> <input
                        name="expiration_date" type="date"
                        value="{{ old('expiration_date') ? old('expiration_date') : $item->expiration_date }}"
                        class="form-control" id="" placeholder="Nhập lý do gia hạn">
                    <small id="" class="form-text text-muted"></small>
                    @error('created_at')
                    <input class='form-control' style="color:red" value="{{ $message }}">
                    @enderror
                </div>
                <div class="form-actions">
                    <a class="btn btn-secondary float-right"
                        href="{{ route('admin.packages.show', $item->package_user->package_id) }}">Hủy</a>
                    <button class="btn btn-primary ml-auto" type="submit">Lưu</button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection