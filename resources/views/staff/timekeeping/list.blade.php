<table class="table table-bordered table-hover">
    @if (blank($timekeeping))
        <div>
            <p class="text-center bg-secondary py-3">
                không có kết quả !
            </p>
        </div>
    @else

            <tbody>
                <tr>
                    <th scope="row">Số công</th>
                    <td>{{ $timekeeping->working_days }}</td>
                    <td></td>
                    <th scope="row">Số ngày nghỉ</th>
                    <td>{{ $timekeeping->day_off }}</td>
                </tr>
                <tr>
                    <th scope="row">Số lần đi muộn</th>
                    <td>{{ $timekeeping->arrive_late }}</td>
                    <td></td>
                    <th scope="row">Số lần về sớm</th>
                    <td>{{ $timekeeping->leave_early }}</td>
                </tr>
                <tr>
                    <th scope="row">Tổng thời gian đi muộn</th>
                    <td>{{ $timekeeping->hours_late }}</td>
                    <td></td>
                    <th scope="row">Tổng thời gian về sớm</th>
                    <td>{{ $timekeeping->hours_early }}</td>
                </tr>
            </tbody>

    @endif
</table>
