<table class="table table-bordered table-hover">
    @if (blank($timekeeping))
        <div>
            <p class="text-center bg-secondary py-3">
                không có kết quả !
            </p>
        </div>
    @else
        @foreach ($timekeeping as $time)
            <tbody>
                <tr>
                    <th scope="row">Số công</th>
                    <td>{{ $time->working_days }}</td>
                    <td></td>
                    <th scope="row">Số ngày nghỉ</th>
                    <td>{{ $time->day_off }}</td>
                </tr>
                <tr>
                    <th scope="row">Số lần đi muộn</th>
                    <td>{{ $time->arrive_late }}</td>
                    <td></td>
                    <th scope="row">Số lần về sớm</th>
                    <td>{{ $time->leave_early }}</td>
                </tr>
                <tr>
                    <th scope="row">Tổng thời gian đi muộn</th>
                    <td>{{ $time->hours_late }}</td>
                    <td></td>
                    <th scope="row">Tổng thời gian về sớm</th>
                    <td>{{ $time->hours_early }}</td>
                </tr>
            </tbody>
        @endforeach
    @endif
</table>
