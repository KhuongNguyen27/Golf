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
    <div class="d-md-flex align-items-md-start">
        <h1 class="page-title mr-sm-auto">Quản Lý Chi Tiết Đơn Hàng</h1>
        <div class="btn-toolbar">
            <!-- <a href="{{ route('admin.orders.create') }}" class="btn btn-primary mr-2" title="Thêm mới đơn hàng">
                <i class="fa-solid bx bx-plus"></i>
                <span class="ml-1">Thêm Mới</span>
            </a> -->
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
                            <th colspan="6" class='text-left'><b class='fw-normal'>Mã đơn hàng :
                                    {{$item->id}}</br>Note : {{$item->note}}</b></th>
                        </tr>
                        <tr class="table-primary">
                            <th>Sản phẩm</th>
                            <th>Số lượng</th>
                            <th>Giá Tiền</th>
                            <th>Tổng Tiền</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($item->orderdetail as $orderdetail)
                        <tr>
                            <td>{{ $orderdetail->product_name }}</td>
                            <td>{{ $orderdetail->quantity }}</td>
                            <td>{{ $orderdetail->price_fm }}</td>
                            <td>{{ $orderdetail->total_fm }}</td>
                            <td>
                                <span class="sr-only">Edit</span></a> <a
                                    href="{{ route('admin.orderdetails.edit', $orderdetail->id) }}"
                                    class="btn btn-sm btn-icon btn-secondary" title="Chỉnh sửa đơn hàng"><i
                                        class='bx bx-edit-alt'></i></a>
                                <form action="{{ route('admin.orderdetails.destroy', $orderdetail->id) }}"
                                    style="display:inline" method="post">
                                    @csrf
                                    @method('delete')
                                    <button onclick="return confirm('Xóa {{ $orderdetail->name }} ?')"
                                        class="btn btn-sm btn-icon btn-secondary" title="Xóa đơn hàng"><i
                                            class='bx bx-trash'></i></button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @endsection