@extends('layouts.app')

@section('title')
    <title>Thông tin lương</title>
@endsection

@section('content')
    <div class="container pt-4">
        @foreach ($salarys as $salary)
            <h2 class="text-center pb-3">
                Thông tin Lương tháng {{ date('m-Y', strtotime($salary->month)) }}
            </h2>
            <form action="{{ route('admin.salary.update', $salary->user_id) }}" method="post">
                @csrf
                <div class="row mx-lg-5 mx-2">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Tên nhân viên</label>
                            <input type="text" class="form-control" value="{{ $salary->name }}" readonly>
                        </div>
                        <div class="form-group">
                            <label>Chức vụ</label>
                            <input type="text" class="form-control" value="{{ $salary->position_name }}" readonly>
                        </div>
                        <div class="form-group">
                            <label>Phòng ban</label>
                            <input type="text" class="form-control" value="{{ $salary->department }}" readonly>
                        </div>
                        <div class="form-group">
                            <label>Lương cơ bản</label>
                            <input type="text" class="form-control" id="basic_salary"
                                value="{{ $salary->basic_salary }}" readonly>
                        </div>
                        <input type="hidden" name="month" value="{{ $salary->month }}">
                        <div class="form-group">
                            <label>Số ngày công</label>
                            <input type="text" class="form-control" id="working_days" value="{{ $salary->working_days }}"
                                readonly>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="phone">Phụ cấp</label>
                            <input type="text" class="form-control" name="subsidize" id="subsidize"
                                value="{{ $salary->subsidize }}">
                        </div>
                        <div class="row">
                            <div class="form-group col-6">
                                <label for="text">Tổng thưởng</label>
                                <input type="text" class="form-control" name="" id="total_reward"
                                    value="{{ $total_reward }}" readonly>
                            </div>
                            <div class="form-group col-6">
                                <label for="text">Tổng phạt</label>
                                {{-- <input type="number" class="form-control" name="discipline" value="{{ $salary->discipline }}"> --}}
                                <input type="text" class="form-control" name="" id="total_discipline"
                                    value="{{ $total_discipline }}" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email">Thuế thu nhập</label>
                            <input type="number" class="form-control" name="income_tax" id="income_tax"
                                value="{{ $salary->income_tax }}" readonly>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="">Phương thức</label>
                                    <select class="form-control" name="payment">
                                        @foreach ($payments as $payment)
                                            <option value="{{ $payment->id }}"
                                                {{ $payment->id == $salary->payment ? 'selected' : '' }}>
                                                {{ $payment->payment }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="">Ngày thanh toán</label>
                                    <input type="date" class="form-control" name="date_of_payment"
                                        value="{{ $salary->date_of_payment }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="">Tổng lương</label>
                                    <input type="text" class="form-control" value="" id="salary" readonly>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="">Sau thuế</label>
                                    <input type="text" class="form-control" name="total_money" id="total_money"
                                        value="" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mx-lg-5 m-2">
                    <input type="submit" class="btn btn-primary mx-3" value="Cập nhật">
                    <a href="{{ route('admin.salary') }}" class="btn btn-secondary mx-3">Thoát</a>
                </div>
            </form>

            <script>
                $(function() {
                    let total_reward = Number($("#total_reward").val());
                    let total_discipline = Number($("#total_discipline").val());
                    let basic_salary = '{{ $salary->basic_salary }}';
                    let working_days = Number($("#working_days").val());
                    let subsidize = Number($("#subsidize").val());
                    let total = parseInt(basic_salary) * working_days + total_reward - total_discipline +
                        subsidize;
                    let income_tax = '{{ $salary->income_tax }}';
                    let result = (total * (100 - income_tax)) / 100;
                    $('#salary').val(total);
                    $('#total_money').val(result);

                    $("#subsidize").on("change", function() {
                        let total_reward = Number($("#total_reward").val());
                        let total_discipline = Number($("#total_discipline").val());
                        let basic_salary = '{{ $salarys[0]->basic_salary }}';
                        let working_days = Number($("#working_days").val());
                        let subsidize = Number($("#subsidize").val());
                        let total = parseInt(basic_salary) * working_days + total_reward - total_discipline +
                            subsidize;
                        if (total < 15000000) {
                            $('#income_tax').val(5);
                        } else if (total < 30000000) {
                            $('#income_tax').val(10);
                        } else if (total < 45000000) {
                            $('#income_tax').val(15);
                        } else {
                            $('#income_tax').val(20);
                        }
                        let incom_tax = $("#income_tax").val();
                        let result = (total * (100 - incom_tax)) / 100;
                        $('#salary').val(total);
                        $('#total_money').val(result);
                    });
                });
            </script>
        @endforeach

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
                                {{ $decision->date_created }}
                            </td>
                            <td>
                                <a href="{{ route('admin.reward-discipline.show', $decision->user_id) }}"
                                    class="mx-1"><i class="fa-solid fa-eye"></i></a>
                                <a href="" class="mx-1" onclick="return confirmDelete()"><i
                                        class="fa-solid fa-trash-can"></i></a>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>

@endsection
