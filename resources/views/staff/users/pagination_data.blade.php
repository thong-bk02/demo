<table class="table table-hover table-sm position-sticky">
    <thead class="thead-dark">
        <tr>
            <th scope="col">Stt</th>
            <th scope="col">Tên nhân viên</th>
            <th scope="col">Chức vụ</th>
            <th scope="col">Phòng ban</th>
            <th scope="col">Giới tính</th>
            <th scope="col">Quên quán</th>
            <th scope="col">Ngày sinh</th>
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
    @endif
    <tbody id="personnel_search_list">
        @foreach ($users as $user)
            <tr class="border-bottom border-dark">
                <th scope="row">
                    {{ ($users->currentPage() - 1) * $users->links()->paginator->perPage() + $loop->iteration }}
                </th>
                <td>{{ $user->name }}</td>
                <td>{{ $user->position_name }}</td>
                <td>{{ $user->department }}</td>
                <td>{{ $user->gender }}</td>
                <td>{{ $user->address }}</td>
                <td>{{ date('d/m/Y', strtotime($user->birthday)) }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
<div id="pagination">
    {{ $users->links() }}
</div>
