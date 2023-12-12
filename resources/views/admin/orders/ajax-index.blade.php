<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th>Tên</th>
                <th>Mã thành viên</th>
                <th>Ngày sinh</th>
                <th>Số điện thoại</th>
                <th>Chức năng</th>
            </tr>
        </thead>
        <tbody>
            @foreach($items as $item)
            <tr>
                <td>{{ $item->name }}</td>
                <td>{{ $item->code }}</td>
                <td>{{ $item->birthday }}</td>
                <td>{{ $item->phone }}</td>
                <td>
                    <a title="Xem" class="btn btn-sm btn-icon btn-secondary"
                        href="{{ route('users.show', $item->id) }}">
                        <i class='bx bx-show-alt'></i>
                    </a>
                    <form action="{{ route('users.destroy', $item->id) }}" style="display:inline" method="post">
                        @csrf
                        @method('delete')
                        <button onclick="return confirm('Xóa {{ $item->name }} ?')"
                            class="btn btn-sm btn-icon btn-secondary"><i class='bx bx-trash'></i></button>
                    </form>
                    <span class="sr-only">Edit</span></a> <a href="{{ route('users.edit', $item->id) }}"
                        class="btn btn-sm btn-icon btn-secondary"><i class='bx bx-edit-alt'></i>
                        <span class="sr-only">Remove</span></a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>