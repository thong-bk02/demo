<table class="table table-hover table-sm position-sticky table-bordered">
    <thead class="thead-dark">
        <tr>
            <th scope="col">Stt</th>
            <th scope="col">Tên nhân viên</th>
            <th scope="col">Mã nhân viên</th>
            <th scope="col">Chức vụ</th>
            <th scope="col">Phòng ban</th>
            <th scope="col">Truy cập</th>
            <th scope="col">Trạng thái</th>
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
    @endif
    <tbody id="personnel_search_list">
        @foreach ($users as $user)
            <tr class="border-bottom border-dark">
                <th scope="row">
                    {{ ($users->currentPage() - 1) * $users->links()->paginator->perPage() + $loop->iteration }}
                </th>
                <td>{{ $user->name }}</td>
                <td>{{ $user->user_code }}</td>
                <td>{{ $user->position_name }}</td>
                <td>{{ $user->department }}</td>
                <td>
                    @if ($user->admin == 1)
                        <a href="" class="badge badge-primary" data-toggle="modal"
                            data-target="#exampleModal{{ $user->user_id }}">Quản trị viên</a>
                    @else
                        <a href="" class="badge badge-dark" data-toggle="modal"
                            data-target="#exampleModal{{ $user->user_id }}">Người dùng</a>
                    @endif

                </td>
                <td>
                    @if ($user->status == 2)
                        <span class="badge badge-secondary">đã nghỉ</span>
                    @elseif ($user->status == 1)
                        <span class="badge badge-success">đang làm</span>
                    @endif
                </td>
                <td>
                    <a href="{{ route('admin.user.show', $user->user_id) }}" class="mx-1"><i
                            class="fa-solid fa-eye"></i></a>
                    <a href="{{ route('admin.user.delete', $user->user_id) }}" class="mx-1"
                        onclick="return confirmDelete()"><i class="fa-solid fa-trash-can"></i></a>
                </td>
            </tr>
            <div class="modal fade" id="exampleModal{{ $user->user_id }}" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Xác Quyền Truy Cập</h5>
                        </div>
                        <div class="modal-body">
                            Bạn có chắc muốn thay đổi quyền truy cập của {{ $user->name }} từ @if ($user->admin == 1)
                                <span class="badge badge-primary p-2">Quản Trị Viên</span> thành <span
                                    class="badge badge-secondary p-2">Nhân viên</span> ?
                            @else
                                <span class="badge badge-secondary p-2">Nhân Viên</span> thành <span
                                    class="badge badge-primary p-2">Quản Trị Viên</span> ?
                            @endif
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                            <a href="{{ route('admin.access-rights', [$user->user_id, $user->admin]) }}"
                                class="btn btn-primary">Chấp Nhận</a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </tbody>
</table>
<div id="pagination">
    {{ $users->links() }}
</div>
