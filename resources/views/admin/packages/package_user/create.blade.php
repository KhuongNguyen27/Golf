@extends('admin.layouts.master')
@section('content')
<header class="page-title-bar">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active">
                <a href="{{ route($route_prefix.'index',$request->package_id) }}"><i
                        class="breadcrumb-icon bx bx-arrow-back mr-2"></i>Quay
                    Lại</a>
            </li>
        </ol>
    </nav>
    <h1 class="page-title">Thêm Thành Viên</h1>
</header>
<div class="page-section">
    <form method="post" action="{{ route($route_prefix.'store') }}" enctype="multipart/form-data">
        @csrf
        <div class="card">
            <div class="card-body">
                <legend>Thông tin cơ bản</legend>
                <input type="hidden" name="package_id" value="{{$request->package_id}}">
                <div class="form-group">
                    <div class="d-flex justify-content-between">
                        <label for="tf1">Tên Thành Viên <abbr name="Trường bắt buộc">*</abbr></label>
                        <a class='badge badge-primary mt-1' href="{{route('admin.users.create')}}">Tạo tài khoản</a>
                    </div>
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
                <div class="float-right mt-2">
                    <button type="submit" class="btn btn-primary">Đăng kí gói</button>
                </div>
            </div>
    </form>
</div>
@endsection