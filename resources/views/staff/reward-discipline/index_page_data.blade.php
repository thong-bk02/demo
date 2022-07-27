<table class="table table-sm table-hover">
    <thead class="thead-dark">
        <tr>
            <th scope="col">Stt</th>
            <th scope="col">Hình thức</th>
            <th scope="col">Lí do</th>
            <th scope="col">Note</th>
            <th scope="col">Số tiền</th>
            <th scope="col">Ngày quyết định</th>
        </tr>
    </thead>
    @if (blank($decisions))
        <tbody>
            <tr>
                <td colspan="8">
                    <p class="alert alert-secondary text-center">Không có kết quả !</p>
                </td>
            </tr>
        </tbody>
    @else
        <tbody>
            @foreach ($decisions as $decision)
                <tr class="border-bottom border-dark">
                    <th scope="row">
                        {{ ($decisions->currentPage() - 1) * $decisions->links()->paginator->perPage() + $loop->iteration }}
                    </th>
                    <td>
                        {{ $decision->genre }}
                    </td>
                    <td>
                        {{ $decision->reasion }}
                    </td>
                    <td>
                        {{ $decision->note }}
                    </td>
                    <td>
                        {{ number_format($decision->money, 0) }}đ
                    </td>
                    <td>
                        {{ date('d/m/Y', strtotime($decision->date_created)) }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    @endif
</table>
<div id="pagination">
    {{ $decisions->links() }}
</div>
