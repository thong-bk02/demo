<table class="table">
    <thead class="thead-dark">
        <tr>
            <th scope="col">Stt</th>
            <th scope="col">Tên nhân sự</th>
            <th scope="col">Ngày bắt đầu</th>
            <th scope="col">Hiện tại</th>
            <th scope="col">Tổng số ngày làm</th>
            <th scope="col">Thao tác</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($timekeepings as $timekeeping)
            <tr class="border-bottom border-dark">
                <th scope="row"> {{ ($timekeepings->currentPage() - 1) * $timekeepings->links()->paginator->perPage() + $loop->iteration }}</th>
                <td>
                    {{ $timekeeping->name }}
                </td>
                <td>
                    {{ $timekeeping->from_date }}
                </td>
                <td>
                    {{ $timekeeping->to_date }}
                </td>
                <td>
                    {{ $timekeeping->working_days }}
                </td>
                <td>
                    <a href="{{ route('admin.timekeeping.show', $timekeeping->user_id) }}" class="mx-1"><i
                            class="fa-solid fa-eye"></i></a>
                    <a href="{{ route('admin.timekeeping.delete', $timekeeping->user_id) }}" class="mx-1" onclick="return confirmDelete()"><i
                            class="fa-solid fa-trash-can"></i></a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<div id="pagination">
    {{ $timekeepings->links() }}
</div>
