@extends('staff.layouts.app')

@section('title')
    <title>Thông tin chấm công</title>
@endsection

@section('content')
    <div class="container">
        <h2 class="mb-4">
            Chấm công
        </h2>
        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th scope="col" colspan="7">Tên nhân viên : {{ $timekeeping->name }}</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th style="width: 10rem;">Chức vụ</th>
                    <td>{{ $timekeeping->position_name }}</td>
                    <td></td>
                    <th style="width: 10rem;">Phòng ban</th>
                    <td>{{ $timekeeping->department }}</td>
                    <td></td>
                    <th>
                        Tháng công:
                        <input type="month" name="month" id="month" value="{{ Date('Y-m') }}">
                    </th>
                </tr>
            </tbody>
        </table>

        <div id="data"></div>
    </div>

    <script>
        $(function() {
            var month = $("month").val();
            $.ajax({
                url: "{{ route('timekeeping') }}",
                method: "GET",
                data: {
                    month: month
                },
                success: function(data) {
                    $('#data').html(data);
                }
            });
            $("#month").on("change", function() {
                var month = $(this).val();
                $.ajax({
                    url: "{{ route('timekeeping') }}",
                    method: "GET",
                    data: {
                        month: month
                    },
                    success: function(data) {
                        $('#data').html(data);
                    }
                });
            });
        });
    </script>
@endsection
