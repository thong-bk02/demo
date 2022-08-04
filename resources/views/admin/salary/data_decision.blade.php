<div class="text-center py-4 h2">Danh sách quyết định thưởng - phạt</div>
<table class="table table-hover">
    <thead class="thead-dark">
        <tr>
            <th scope="col">Hình thức</th>
            <th scope="col">Lí do</th>
            <th scope="col">Số tiền</th>
            <th scope="col">Ngày quyết định</th>
            <th scope="col">Thao tác</th>
        </tr>
    </thead>
    <tbody>
        @if (blank($decisions))
            <tr>
                <td colspan="5" class="text-center bg-secondary">Không có quyết định thưởng - phạt!</td>
            </tr>
        @else
            @foreach ($decisions as $decision)
                <tr class="border-bottom border-dark">
                    <td>
                        {{ $decision->genre }}
                    </td>
                    <td>
                        {{ $decision->reasion }}
                    </td>
                    <td>
                        {{ number_format($decision->money, 0) }}
                    </td>
                    <td>
                        {{ date('d-m-Y', strtotime($decision->date_created)) }}
                    </td>
                    <td>
                        <a href="{{ route('admin.reward-discipline.show', $decision->user_id) }}" class="mx-1"><i
                                class="fa-solid fa-eye"></i></a>
                        <a href="" class="mx-1" onclick="return confirmDelete()"><i
                                class="fa-solid fa-trash-can"></i></a>
                    </td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>
