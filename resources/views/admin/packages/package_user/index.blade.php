@extends('admin.layouts.master')
@section('content')
<header class="page-title-bar">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active">
                <a href="{{ route('admin.packages.index') }}"><i class="breadcrumb-icon bx bx-arrow-back mr-2"></i>Quay
                    Lại</a>
            </li>
        </ol>
    </nav>
    <div class="d-md-flex align-items-md-start">
        <h1 class="page-title mr-sm-auto">Quản Lý {{ $package->name }}</h1>
        <div class="btn-toolbar">
            <a href="{{ route($route_prefix.'create',['package_id' => $package->id]) }}" class="btn btn-primary mr-2"
                title="Thêm mới khách hàng">
                <i class="fa-solid bx bx-plus"></i>
                <span class="ml-1">Thêm Mới</span>
            </a>
        </div>
    </div>
</header>
<div class="page-section">
    @if (session('success'))
    <div class="alert alert-success" role="alert">
        {{ session('success') }}
    </div>
    @endif
    @if (session('error'))
    <div class="alert alert-danger" role="alert">
        {{ session('error') }}
    </div>
    @endif
    <div class="card card-fluid">
        <div class="card-header">
            <ul class="nav nav-tabs card-header-tabs">
                <li class="nav-item">
                    <a class="nav-link active " href="">Tất Cả</a>
                </li>
            </ul>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Tên khách hàng</th>
                            <th>Ngày đăng kí</th>
                            <th>Ngày hết hạn</th>
                            <th>Lần sử dụng</th>
                            @if($package->id == 2 || $package->id == 4)
                            <th>Thời gian sử dụng(Giờ)</th>
                            @endif
                            @if($package->id !== 4)
                            <th>Đã gia hạn</th>
                            @endif
                            <th>Xếp hạng</th>
                            <!-- <th>Trạng thái</th> -->
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($items as $item)
                        <tr>
                            <td>{{ $item->user_name }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->register_day)->format('d/m/Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->expiration_date)->format('d/m/Y') }}</td>
                            <td>{{ $item->used_numbers }}</td>
                            @if($package->id == 2 || $package->id == 4)
                            <td>{{ $item->total_hour }}</td>
                            @endif
                            @if($package->id !== 4)
                            <td>{{ $item->expiration_count }}</td>
                            @endif
                            <td>{{ $item->rank_name }}</td>
                            <!-- <td>{!! $item->status_fm !!}</td> -->
                            <td class="d-flex">
                                <a href="{{ route('admin.userproducts.create',$item->id) }}"
                                    class="btn btn-sm btn-icon btn-secondary" title="Thêm chi tiết"><i
                                        class='bx bx-plus'></i></a>
                                <a href="{{ route('admin.userproducts.index',$item->id) }}"
                                    class="btn btn-sm btn-icon btn-secondary" title="Xem chi tiết sử dụng"><i
                                        class='bx bx-bullseye'></i></a>
                                @if($item->package_id != 4)
                                <a href="{{ route('admin.expirations.create',$item->id) }}"
                                    class="btn btn-sm btn-icon btn-secondary" title="Gia hạn 1 ngày"><i
                                        class='bx bx-expand-horizontal'></i></a>
                                @endif
                                <form action="{{ route($route_prefix.'destroy',$item->id) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-sm btn-icon btn-secondary"
                                        onclick="return confirm('Bạn có muốn xóa {{ $item->user_name }} khỏi gói không ?')"
                                        title="Xóa người dùng gói"><i class='bx bx-trash'></i></button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @endsection