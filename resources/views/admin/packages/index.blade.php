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
    <div class="d-md-flex align-items-md-start">
        <h1 class="page-title mr-sm-auto">Quản Lý Gói</h1>
        <div class="btn-toolbar">
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
                            <th>Tên</th>
                            <th>Giá tiền</th>
                            <th>Thời hạn</th>
                            <th>Trạng thái</th>
                            <th>Thành viên</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($items as $item)
                        <tr>
                            <td>
                                <a href="{{ route('admin.packages.show', $item->id) }}">{{ $item->name }}</a>
                                </a>
                            </td>
                            <td>{{ number_format(intval($item->price), 0, ',', '.') }} VNĐ</td>
                            <td>{{ $item->duration_name }}</td>
                            <td>{!! $item->status_fm !!}</td>
                            <td>
                                <a href="{{ route('admin.packages.show', $item->id) }}"
                                    class="btn btn-sm btn-icon btn-secondary" title="Chỉnh sửa thành viên"><i
                                        class='bx bx-group'></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @endsection