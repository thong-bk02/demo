@extends('layouts.app')

@section('title')
    <title>Thêm Lương</title>
@endsection

@section('content')
    <div class="container">
            <h2 class="text-center py-3">
                Thêm Lương
            </h2>
            <form action="{{ route('admin.salary.store', $salarys[0]->user_id) }}" method="post">
                @csrf
                <div class="row mx-lg-5 mx-2">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Tên nhân viên</label>
                            <input type="text" class="form-control" value="{{ $salarys[0]->name }}" readonly>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Chức vụ</label>
                                    <input type="text" class="form-control" value="{{ $salarys[0]->position_name }}"
                                        readonly>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Phòng ban</label>
                                    <input type="text" class="form-control" value="{{ $salarys[0]->department }}" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Lương tháng</label>
                            <input type="month" id='date_input' class="form-control" name="month" required>
                        </div>
                        <div class="form-group">
                            <label for="">Lương cơ bản</label>
                            <select class="form-control" name="coefficients_salary" id="coefficients_salary">
                                @foreach ($basic_salary as $basic)
                                    {!! $basic->coefficients_salary == $salarys[0]->coefficients_salary
                                        ? '<option value="' . $basic->id . '">' . $basic->coefficients_salary . '</option>'
                                        : '' !!}
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Số ngày công</label>
                            <input type="text" class="form-control" id="working_days" value=""
                                readonly>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="row">
                            <div class="form-group col-6">
                                <label for="text">Tổng thưởng</label>
                                <input type="text" class="form-control" name="total_reward" id="total_reward"
                                    value="" readonly>
                            </div>
                            <div class="form-group col-6">
                                <label for="text">Tổng phạt</label>
                                <input type="text" class="form-control" name="total_discipline" id="total_discipline"
                                    value="" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email">Thuế thu nhập (%)</label>
                            <input type="number" class="form-control" name="income_tax" id="incom_tax" value=""
                                readonly>
                        </div>
                        <div class="form-group">
                            <label for="phone">Phụ cấp</label>
                            <input type="number" class="form-control" id="subsidize" name="subsidize" value=""
                                autocomplete="off">
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="">Thanh toán</label>
                                    <select class="form-control" name="payment">
                                        @foreach ($payments as $payment)
                                            <option value="{{ $payment->id }}">
                                                {{ $payment->payment }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="email">Ngày quyết toán</label>
                                    <input type="date" class="form-control" name="date_of_payment" value="">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="email">Tổng lương</label>
                                    <input type="text" class="form-control" value="" id="salary" readonly>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="email">Sau thuế</label>
                                    <input type="text" class="form-control" name="total_money" id="total_money"
                                        value="" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mx-lg-5 m-2">
                    <input type="submit" class="btn btn-primary mx-3" value="Lưu">
                    <a href="{{ route('admin.salary') }}" class="btn btn-secondary mx-3">Thoát</a>
                    <a href="{{ route('admin.salary.list') }}" class="btn btn-secondary mx-3">Đổi nhân sự</a>
                </div>
            </form>

            <div id="data"></div>

            <script>
                $(function() {
                    $("#date_input").on("change", function() {
                        var month = $(this).val();
                        var user_id = {{ $salarys[0]->user_id }};
                        $.ajax({
                            url: "{{ route('admin.salary.create', $salarys[0]->user_id) }}",
                            method: "GET",
                            data: {
                                month: month
                            },
                            success: function(data) {
                                $('#data').html(data);
                            }
                        });
                        $.ajax({
                            url: "{{ route('admin.salary.money') }}",
                            method: "GET",
                            data: {
                                month: month,
                                user_id: user_id,
                            },
                            success: function(data) {
                                $('#total_reward').val(data.total_reward);
                                $('#total_discipline').val(data.total_discipline);
                                $('#working_days').val(data.working_days);
                                let total_reward = Number($("#total_reward").val());
                                let total_discipline = Number($("#total_discipline").val());
                                let basic_salary = '{{ $salarys[0]->coefficients_salary }}';
                                let working_days = Number($("#working_days").val());
                                let subsidize = Number($("#subsidize").val());
                                let total = parseInt(basic_salary) * working_days + total_reward -
                                    total_discipline +
                                    subsidize;
                                if (total < 15000000) {
                                    $('#incom_tax').val(5);
                                } else if (total < 30000000) {
                                    $('#incom_tax').val(10);
                                } else if (total < 45000000) {
                                    $('#incom_tax').val(15);
                                } else {
                                    $('#incom_tax').val(20);
                                }
                                let incom_tax = $("#incom_tax").val();
                                let result = (total * (100 - incom_tax)) / 100;
                                $('#salary').val(total);
                                $('#total_money').val(result);
                            }
                        });
                    });
                });
            </script>

            <script>
                $(function() {
                    $("#subsidize").on("change", function() {
                        let total_reward = Number($("#total_reward").val());
                        let total_discipline = Number($("#total_discipline").val());
                        let basic_salary = '{{ $salarys[0]->coefficients_salary }}';
                        let working_days = Number($("#working_days").val());
                        let subsidize = Number($("#subsidize").val());
                        let total = parseInt(basic_salary) * working_days + total_reward - total_discipline +
                            subsidize;
                        if (total < 15000000) {
                            $('#incom_tax').val(5);
                        } else if (total < 30000000) {
                            $('#incom_tax').val(10);
                        } else if (total < 45000000) {
                            $('#incom_tax').val(15);
                        } else {
                            $('#incom_tax').val(20);
                        }
                        let incom_tax = $("#incom_tax").val();
                        let result = (total * (100 - incom_tax)) / 100;
                        $('#salary').val(total);
                        $('#total_money').val(result);
                    });
                });
            </script>
        
    </div>
@endsection
