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
    <form method="post" action="{{ route('admin.users.update',$item->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="card">
            <div class="card-body">
                <legend>Thông tin cơ bản</legend>
                <div class="form-group">
                    <label for="tf1">Tên Thành Viên <abbr name="Trường bắt buộc">*</abbr></label> <input name="name"
                        type="text" value="{{ old('name')? old('name') : $item->name }}" class="form-control" id=""
                        placeholder="Nhập tên thành viên">
                    <small id="" class="form-text text-muted"></small>
                    @error('name')
                    <input class='form-control' style="color:red" value="{{ $message }}">
                    @enderror
                </div>
                <div class="form-group">
                    <label for="tf1">Ngày Sinh</label> <input name="birthday" type="date"
                        value="{{ old('birthday')? old('birthday') : $item->birthday }}" class="form-control" id=""
                        placeholder="Nhập ngày sinh">
                    <small id="" class="form-text text-muted"></small>
                </div>
                <div class="form-group">
                    <label for="tf1">Số Điện Thoại</label> <input name="phone" type="text"
                        value="{{ old('phone')? old('phone') : $item->phone }}" class="form-control" id=""
                        placeholder="Nhập số điện thoại">
                    <small id="" class="form-text text-muted"></small>
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