<table class="table table-sm table-hover table-bordered">
    <thead class="thead-dark">
        <tr>
            <th scope="col">Stt</th>
            <th scope="col">Tên nhân viên</th>
            <th scope="col">Giới tính</th>
            <th scope="col">Chức vụ</th>
            <th scope="col">Tháng lương</th>
            <th scope="col">Tổng lương</th>
            <th scope="col">Ngày quyết toán</th>
            <th scope="col">Thao tác</th>
        </tr>
    </thead>
    @if (blank($salarys))
        <tbody>
            <tr>
                <td colspan="8">
                    <p class="alert alert-secondary text-center">Không có kết quả !</p>
                </td>
            </tr>
        </tbody>
    @else
        <tbody>
            @foreach ($salarys as $key => $salary)
                <tr class="border-bottom border-dark">
                    <th scope="row">
                        {{ ($salarys->currentPage() - 1) * $salarys->links()->paginator->perPage() + $loop->iteration }}
                    </th>
                    <td>
                        {{ $salary->name }}
                    </td>
                    <td>
                        {{ $salary->gender }}
                    </td>
                    <td>
                        {{ $salary->position_name }}
                    </td>
                    <td>
                        {{ date('m/Y', strtotime($salary->month)) }}
                    </td>
                    <td>
                        {{ number_format($salary->total_money, 0) }} VNĐ
                    </td>
                    <td>
                        @if (blank($salary->date_of_payment))
                            {{ 'Chưa thanh toán' }}
                        @else
                            {{ date('d/m/Y', strtotime($salary->date_of_payment)) }}
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.salary.show', $salary->salary_code) }}" class="btn btn-outline-primary btn-sm"><i
                                class="fa-solid fa-eye"></i></a>
                        <a class="btn btn-outline-success btn-sm"
                            href="{{ route('admin.salary.exportOne', $salary->salary_code) }}">
                            <i class="fa-solid fa-arrow-right-from-bracket"></i>
                        </a>
                        <a href="{{ route('admin.salary.delete', $salary->salary_code) }}" class="btn btn-outline-primary btn-sm"
                            onclick="return confirmDelete()"><i class="fa-solid fa-trash-can"></i></a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    @endif
</table>
<div id="pagination">
    {{ $salarys->links() }}
</div>
