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
    <div class="card card-fluid">
        <div class="card-header">
            <ul class="nav nav-tabs card-header-tabs">
                <li class="nav-item">
                    <a class="nav-link"
                        href="{{ route('admin.userproducts.create',['user_id' => $id, 'package_id' => $package_id ]) }}">Ngoài
                        Trời</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="">3D</a>
                </li>
            </ul>
        </div>
        <form method="post" action="{{ route('admin.userproducts.storeSingle') }}" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <input type="hidden" name="user_id" value="{{$id}}">
                <input type="hidden" name="is_3d" value="true">
                <div class="form-group">
                    <label for="tf1">Từ<abbr name="Trường bắt buộc">*</abbr></label> <input name="hour_to" type="number"
                        value="{{ old('hour_to') }}" class="form-control" id="" placeholder="Nhập giờ vào">
                    <small id="" class="form-text text-muted"></small>
                    @error('hour_to')
                    <input class='form-control' style="color:red" value="{{ $message }}">
                    @enderror
                </div>
                <div class="form-group">
                    <label for="tf1">Đến<abbr name="Trường bắt buộc">*</abbr></label> <input name="to_hour"
                        type="number" value="{{ old('to_hour') }}" class="form-control" id=""
                        placeholder="Nhập giờ vào">
                    <small id="" class="form-text text-muted"></small>
                    @error('to_hour')
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