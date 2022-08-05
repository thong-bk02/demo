<table class="table table-bordered">
    @if (blank($salarys))
        <div>
            <p class="text-center bg-secondary py-3">
                không có kết quả !
            </p>
        </div>
    @else
        @foreach ($salarys as $salary)
            <tbody>
                <tr>
                    <th scope="row">Tháng lương</th>
                    <td>{{ date('m/Y', strtotime($salary->month)) }}</td>
                    <td></td>
                    <th scope="row">Lương cơ bản</th>
                    <td>{{ number_format($salary->coefficients_salary, 0) }}đ</td>
                    <td></td>
                    <th scope="row">Phụ cấp</th>
                    <td>{{ number_format($salary->subsidize, 0) }}</td>
                </tr>
                <tr></tr>
                <tr>
                    <th scope="row">Tổng tiền thưởng</th>
                    <td>{{ number_format($salary->total_reward, 0) }}đ</td>
                    <td></td>
                    <th scope="row">Tổng tiền phạt</th>
                    <td>{{ number_format($salary->total_discipline, 0) }}đ</td>
                    <td></td>
                    <th scope="row">Thuế thu nhập</th>
                    <td>{{ number_format($salary->income_tax, 2) }}%</td>
                </tr>
                <tr></tr>
                <tr>
                    <th scope="row">Phương thức thanh toán</th>
                    <td>
                        @if (blank($salary->date_of_payment))
                            chưa thanh toán
                        @else
                        {{ $salary->payment }}
                        @endif
                    </td>
                    <td></td>
                    <th scope="row">Ngày thanh toán</th>
                    <td>
                        @if (blank($salary->date_of_payment))
                            chưa thanh toán
                        @else
                            {{ date('d-m-Y', strtotime($salary->date_of_payment)) }}
                        @endif
                    </td>
                    <td></td>
                    <th scope="row">Thành tiền</th>
                    <td>{{ number_format($salary->total_money, 0) }}đ</td>
                </tr>
            </tbody>
        @endforeach
    @endif
</table>
