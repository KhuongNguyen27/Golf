@extends('admin.layouts.master')
@section('content')
<header class="page-title-bar">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active">
                <a href="#"><i class="breadcrumb-icon bx bx-arrow-back mr-2"></i>Trang Chủ </a>
            </li>
        </ol>
    </nav>
    <div class="d-md-flex align-items-md-start">
        <h1 class="page-title mr-sm-auto">Quản Lý Thành Viên</h1>
        <div class="btn-toolbar">
            <a href="{{ route('admin.users.create') }}" class="btn btn-primary mr-2" title="Thêm mới thành viên">
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
                            <th>Tên</th>
                            <th>Ngày sinh</th>
                            <th>Số điện thoại</th>
                            <th>Chức năng</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($items as $item)
                        <tr>
                            <td>
                                <a href="#" class="tile tile-img mr-1">
                                    <img class="img-fluid rounded-circle" src="{{ asset($item->avatar) }}" alt="">
                                </a>
                                {{ $item->name }}
                            </td>
                            <td>{{ $item->birthday?\Carbon\Carbon::parse($item->birthday)->format('d/m/Y'):'' }}</td>
                            <td>{{ $item->phone }}</td>
                            <td>
                                <span class="sr-only">Edit</span></a> <a
                                    href="{{ route('admin.users.edit', $item->id) }}"
                                    class="btn btn-sm btn-icon btn-secondary" title="Chỉnh sửa thành viên"><i
                                        class='bx bx-edit-alt'></i></a>
                                <form action="{{ route('admin.users.destroy', $item->id) }}" style="display:inline"
                                    method="post">
                                    @csrf
                                    @method('delete')
                                    <button onclick="return confirm('Xóa {{ $item->name }} ?')"
                                        class="btn btn-sm btn-icon btn-secondary" title="Xóa thành viên"><i
                                            class='bx bx-trash'></i></button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @endsection