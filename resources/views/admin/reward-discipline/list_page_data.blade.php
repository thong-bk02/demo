<table class="table table-hover table-sm position-sticky table-bordered">
    <thead class="thead-dark">
        <tr>
            <th scope="col">Stt</th>
            <th scope="col">Tên nhân viên</th>
            <th scope="col">Giới tính</th>
            <th scope="col">Mã nhân viên</th>
            <th scope="col">Chức vụ</th>
            <th scope="col">Phòng ban</th>
            <th scope="col">Thao tác</th>
        </tr>
    </thead>
    @if (blank($users))
        <tbody>
            <tr>
                <td colspan="7">
                    <p class="alert alert-secondary text-center">Không có kết quả !</p>
                </td>
            </tr>
        </tbody>
    @else
        <tbody id="personnel_search_list">
            @foreach ($users as $user)
                <tr class="border-bottom border-dark">
                    <th scope="row">
                        {{ ($users->currentPage() - 1) * $users->links()->paginator->perPage() + $loop->iteration }}
                    </th>
                    <td>
                        {{ $user->name }}
                    </td>
                    <td>
                        {{ $user->gender }}
                    </td>
                    <td>
                        {{ $user->user_code }}
                    </td>
                    <td>
                        {{ $user->position_name }}
                    </td>
                    <td>
                        {{ $user->department }}
                    </td>
                    <td class="w-25">
                        <a href="{{ route('admin.reward-discipline.create', $user->user_id) }}" class="btn btn-primary">
                            <i class="fa-solid fa-circle-plus"></i> Thưởng - phạt</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    @endif
</table>
<div id="pagination">
    {{ $users->links() }}
</div>
