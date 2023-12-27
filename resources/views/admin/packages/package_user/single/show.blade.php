@extends('admin.layouts.master')
@section('content')
<header class="page-title-bar">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active">
                <a href="{{ route('admin.packages.show',$package_id) }}"><i
                        class="breadcrumb-icon bx bx-arrow-back mr-2"></i>Quay
                    Lại</a>
            </li>
        </ol>
    </nav>
    <div class="d-md-flex align-items-md-start">
        <h1 class="page-title mr-sm-auto">Quản Lý Lịch Sử Thành Viên </h1>
        <div class="btn-toolbar">
            <a href="{{ route('admin.pdf.create',$item->id) }}" class="btn btn-primary mr-2" title="Xuất file PDF">
                <i class='fa-solid bx bxs-file-export'></i>
                <span class="ml-1">Xuất PDF</span>
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
                    <a class="nav-link active" href="">Ngoài trời</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="?is_3D=true">3D</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.expirations.show',$item->id) }}">Gia Hạn</a>
                </li>
            </ul>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Ngày sử dụng</th>
                            <th>Số lượng</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $total_balls = 0; @endphp
                        @foreach($items as $item)
                        @if($item->balls)
                        @php $total_balls += $item->balls; @endphp
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d/m/Y') }}</td>
                            <td>{{ $item->balls }} bóng</td>
                            <td>
                                <a href="{{ route('admin.userproducts.edit',$item->id) }}"
                                    class="btn btn-sm btn-icon btn-secondary" title="Thêm chi tiết"><i
                                        class='bx bx-edit-alt'></i></a>
                                <form action="{{ route('admin.userproducts.destroy', $item->id) }}"
                                    style="display:inline" method="post">
                                    @csrf
                                    @method('delete')
                                    <button onclick="return confirm('Xóa lịch sử ?')"
                                        class="btn btn-sm btn-icon btn-secondary" title="Xóa thành viên"><i
                                            class='bx bx-trash'></i></button>
                                </form>
                            </td>
                        </tr>
                        @endif
                        @endforeach
                        <tr>
                            <td>
                                <h6>Tổng số bóng</h6>
                            </td>
                            <td>{{ $total_balls }} bóng</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            @endsection