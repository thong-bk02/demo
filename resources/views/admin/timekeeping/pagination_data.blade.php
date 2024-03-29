<table class="table table-hover table-sm table-bordered">
    <thead class="thead-dark">
        <tr>
            <th scope="col">Stt</th>
            <th scope="col">Tên nhân sự</th>
            <th scope="col">Giới tính</th>
            <th scope="col">Chức vụ</th>
            <th scope="col">Phòng ban</th>
            <th scope="col">Tháng</th>
            <th scope="col" class="text-center">Số công</th>
            <th scope="col">Thao tác</th>
        </tr>
    </thead>
    @if (blank($timekeepings))
        <tbody>
            <tr>
                <td colspan="8">
                    <p class="alert alert-secondary text-center">Không có kết quả !</p>
                </td>
            </tr>
        </tbody>
    @else
        <tbody>
            @foreach ($timekeepings as $timekeeping)
                <tr class="border-bottom border-dark">
                    <th scope="row">
                        {{ ($timekeepings->currentPage() - 1) * $timekeepings->links()->paginator->perPage() + $loop->iteration }}
                    </th>
                    <td>
                        {{ $timekeeping->name }}
                    </td>
                    <td>
                        {{ $timekeeping->gender }}
                    </td>
                    <td>
                        {{ $timekeeping->position_name }}
                    </td>
                    <td>
                        {{ $timekeeping->department }}
                    </td>
                    <td>
                        {{ date('m/Y', strtotime($timekeeping->timekeeping_month)) }}
                    </td>
                    <td class="text-center">
                        {{ $timekeeping->working_days }}
                    </td>
                    <td>
                        <a href="{{ route('admin.timekeeping.show', $timekeeping->timekeeping_code) }}"
                            class="btn btn-outline-primary btn-sm"><i class="fa-solid fa-eye"></i>
                        </a>
                        <a class="btn btn-outline-success btn-sm float-end"
                            href="{{ route('admin.timekeeping.exportOne', $timekeeping->timekeeping_code) }}">
                            <i class="fa-solid fa-arrow-right-from-bracket"></i>
                        </a>
                        <a href="{{ route('admin.timekeeping.delete', $timekeeping->timekeeping_code) }}" class="btn btn-outline-danger btn-sm"
                            onclick="return confirmDelete()">
                            <i class="fa-solid fa-trash-can text-danger"></i>
                        </a>

                    </td>
                </tr>
            @endforeach
        </tbody>
    @endif
</table>
<div id="pagination">
    {{ $timekeepings->links() }}
</div>
