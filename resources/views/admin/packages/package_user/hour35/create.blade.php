@extends('admin.layouts.master')
@section('content')
<header class="page-title-bar">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active">
                <a href="{{ URL::previous() }}"><i class="breadcrumb-icon bx bx-arrow-back mr-2"></i>Quay Lại</a>
            </li>
        </ol>
    </nav>
    <h1 class="page-title">Thêm Chi Tiết</h1>
</header>
<div class="page-section">
    <form method="post" action="{{ route('admin.userproducts.store35') }}" enctype="multipart/form-data">
        @csrf
        <div class="card">
            <div class="card-body">
                <legend>Thông tin cơ bản</legend>
                <input type="hidden" name="user_id" value="{{$id}}">
                <div class="form-group">
                    <label for="tf1">Từ<abbr name="Trường bắt buộc">*</abbr></label> <input name="hour_to" type="number"
                        value="{{ old('hour_to') }}" class="form-control" id="" placeholder="Nhập thời gian vào">
                    <small id="" class="form-text text-muted"></small>
                    @error('hour_to')
                    <input class='form-control' style="color:red" value="{{ $message }}">
                    @enderror
                </div>
                <div class="form-group">
                    <label for="tf1">Đến<abbr name="Trường bắt buộc">*</abbr></label> <input name="to_hour"
                        type="number" value="{{ old('to_hour') }}" class="form-control" id=""
                        placeholder="Nhập thời gian ra">
                    <small id="" class="form-text text-muted"></small>
                    @error('to_hour')
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