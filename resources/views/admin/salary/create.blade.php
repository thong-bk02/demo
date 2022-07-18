@extends('layouts.app')

@section('content')
    <div class="container">

        @foreach ($salarys as $salary)
            <h2 class="text-center py-3">
                Thêm Lương
            </h2>
            <form action="{{ route('admin.salary.store', $salary->user_id) }}" method="post">
                @csrf
                <div class="row mx-lg-5 mx-2">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Tên nhân viên</label>
                            <input type="text" class="form-control" value="{{ $salary->name }}" readonly>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Chức vụ</label>
                                    <input type="text" class="form-control" value="{{ $salary->position_name }}"
                                        readonly>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Phòng ban</label>
                                    <input type="text" class="form-control" value="{{ $salary->department }}" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Lương tháng</label>
                            <input type="month" class="form-control" name="month" value="" required>
                        </div>
                        <div class="form-group">
                            <label for="">Lương cơ bản</label>
                            <select class="form-control" name="coefficients_salary">
                                @foreach ($basic_salary as $basic)
                                    <option value="{{ $basic->id }}" 
                                        {{ $basic->coefficients_salary == $salary->coefficients_salary ? 'selected' : '' }}>
                                        {{ $basic->coefficients_salary }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Số ngày công</label>
                            <input type="text" class="form-control" id="working_days"
                                value="{{ $salary->working_days }}" readonly>
                        </div>
                        <input type="hidden" name="timekeeping" value="{{ $salary->id }}">
                    </div>
                    <div class="col-sm-6">

                        <div class="row">
                            <div class="form-group col-6">
                                <label for="text">Tổng thưởng</label>
                                {{-- <input type="number" class="form-control" name="reward" value="{{ $salary->reward }}"> --}}
                                <input type="text" class="form-control" name="total_reward" id="total_reward"
                                    value="{{ number_format($total_reward, 0) }}" readonly>
                            </div>
                            <div class="form-group col-6">
                                <label for="text">Tổng phạt</label>
                                {{-- <input type="number" class="form-control" name="discipline" value="{{ $salary->discipline }}"> --}}
                                <input type="text" class="form-control" name="total_discipline" id="total_discipline"
                                    value="{{ number_format($total_discipline, 0) }}" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email">Thuế thu nhập (%)</label>
                            <input type="number" class="form-control" name="income_tax" id="incom_tax" value=""
                                readonly>
                        </div>
                        <div class="form-group">
                            <label for="phone">Phụ cấp</label>
                            <input type="number" class="form-control" id="subsidize" name="subsidize" value="0"
                                autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="">Thanh toán</label>
                            <select class="form-control" name="payment">
                                @foreach ($payments as $payment)
                                    <option value="{{ $payment->id }}">
                                        {{ $payment->payment }}</option>
                                @endforeach
                            </select>
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
                </div>
            </form>
            <script>
                function sum() {
                    var total_reward = "{{ $total_reward }}";
                    var total_discipline = "{{ $total_discipline }}";
                    var basic_salary = "{{ $salary->coefficients_salary }}";
                    var working_days = "{{ $salary->working_days }}";
                    var subsidize = 0;
                    $("#subsidize").change(function() {
                        var subsidize = parseInt($("#subsidize").val());
                        if (!subsidize) {
                            var total = basic_salary * working_days + (total_reward - total_discipline);
                        } else {
                            var total = basic_salary * working_days + (total_reward - total_discipline) + subsidize;
                        }
                        if (total < 15000000) {
                            $('#incom_tax').val(5);
                        } else if (total < 30000000) {
                            $('#incom_tax').val(10);
                        } else if (total < 45000000) {
                            $('#incom_tax').val(15);
                        } else {
                            $('#incom_tax').val(20);
                        }
                        var incom_tax = $("#incom_tax").val();
                        var result = (total * (100 - incom_tax)) / 100;
                        $('#salary').val(total);
                        $('#total_money').val(result);
                    });

                    var total = basic_salary * working_days + (total_reward - total_discipline);
                    if (total < 15000000) {
                        $('#incom_tax').val(5);
                    } else if (total < 30000000) {
                        $('#incom_tax').val(10);
                    } else if (total < 45000000) {
                        $('#incom_tax').val(15);
                    } else {
                        $('#incom_tax').val(20);
                    }
                    var incom_tax = $("#incom_tax").val();
                    $('#salary').val(total);
                    var result = (total * (100 - incom_tax)) / 100;
                    $('#total_money').val(result);

                }
                $(document).ready(function() {
                    sum();
                })
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
