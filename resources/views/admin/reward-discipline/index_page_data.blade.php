<table class="table table-sm table-hover">
    <thead class="thead-dark">
        <tr>
            <th scope="col">Stt</th>
            <th scope="col">Tên nhân viên</th>
            <th scope="col">chức vụ</th>
            <th scope="col">phòng ban</th>
            <th scope="col">Hình thức</th>
            <th scope="col">Số tiền</th>
            <th scope="col">Ngày quyết định</th>
            <th scope="col">Thao tác</th>
        </tr>
    </thead>
    @if (blank($reward_and_disciplines))
        <tbody>
            <tr>
                <p class="alert alert-secondary text-center">Không có kết quả !</p>
            </tr>
        </tbody>
    @else
        <tbody>
            @foreach ($reward_and_disciplines as $reward_and_discipline)
                <tr class="border-bottom border-dark">
                    <th scope="row">
                        {{ ($reward_and_disciplines->currentPage() - 1) * $reward_and_disciplines->links()->paginator->perPage() + $loop->iteration }}
                    </th>
                    <td>
                        {{ $reward_and_discipline->name }}
                    </td>
                    <td>
                        {{ $reward_and_discipline->position_name }}
                    </td>
                    <td>
                        {{ $reward_and_discipline->department }}
                    </td>
                    <td>
                        {{ $reward_and_discipline->genre }}
                    </td>
                    <td>
                        {{ number_format($reward_and_discipline->money,0) }}
                    </td>
                    <td>
                        {{ $reward_and_discipline->date_created }}
                    </td>
                    <td>
                        <a href="{{ route('admin.reward-discipline.show', $reward_and_discipline->id) }}"
                            class="mx-1"><i class="fa-solid fa-eye"></i></a>
                        <a href="{{ route('admin.reward-discipline.delete', $reward_and_discipline->id) }}" class="mx-1" onclick="return confirmDelete()"><i
                                class="fa-solid fa-trash-can"></i></a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    @endif
</table>
<div id="pagination">
    {{ $reward_and_disciplines->links() }}
</div>
