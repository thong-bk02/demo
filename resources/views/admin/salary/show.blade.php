@extends('layouts.app')

@section('content')
    <div class="container">

        @foreach ($salarys as $salary)
            <h2 class="text-center py-3">
                Thông tin Lương tháng {{ $salary->month }}
            </h2>
            <form action="{{ route('admin.salary.update', $salary->user_id) }}" method="post">
                @csrf
                <div class="row mx-lg-5 mx-2">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Tên nhân viên</label>
                            <input type="text" class="form-control" value="{{ $salary->name }}" disabled>
                        </div>
                        <div class="form-group">
                            <label>Chức vụ</label>
                            <input type="text" class="form-control" value="{{ $salary->position_name }}" disabled>
                        </div>
                        <div class="form-group">
                            <label>Phòng ban</label>
                            <input type="text" class="form-control" value="{{ $salary->department }}" disabled>
                        </div>
                        <div class="form-group">
                            <label>Lương cơ bản</label>
                            <input type="text" class="form-control"
                                value="{{ number_format($salary->coefficients_salary, 0) }}" disabled>
                        </div>
                        <div class="form-group">
                            <label>Số ngày công</label>
                            <input type="text" class="form-control" value="{{ $salary->working_days }}" disabled>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="phone">Phụ cấp</label>
                            <input type="text" class="form-control" name="absence"
                                value="{{ number_format($salary->subsidize, 0) }}">
                        </div>
                        <div class="row">
                            <div class="form-group col-6">
                                <label for="text">Tổng thưởng</label>
                                {{-- <input type="number" class="form-control" name="reward" value="{{ $salary->reward }}"> --}}
                                <input type="text" class="form-control" name=""
                                    value="{{ number_format($total_reward, 0) }}" disabled>
                            </div>
                            <div class="form-group col-6">
                                <label for="text">Tổng phạt</label>
                                {{-- <input type="number" class="form-control" name="discipline" value="{{ $salary->discipline }}"> --}}
                                <input type="text" class="form-control" name=""
                                    value="{{ number_format($total_discipline, 0) }}" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email">Thuế thu nhập</label>
                            <input type="number" class="form-control" value="{{ $salary->income_tax }}" disabled>
                        </div>
                        <div class="form-group">
                            <label for="">Thanh toán</label>
                            <select class="form-control" name="payment">
                                @foreach ($payments as $payment)
                                    <option value="{{ $payment->id }}"
                                        {{ $payment->id == $salary->payment ? 'selected' : '' }}>
                                        {{ $payment->payment }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="email">Tổng lương</label>
                            <input type="text" class="form-control"
                                value="{{ number_format($salary->total_money, 0) }}" pattern="[0-9]+" disabled>
                        </div>
                    </div>
                </div>

                <div class="mx-lg-5 m-2">
                    <input type="submit" class="btn btn-primary mx-3" value="Lưu">
                    <a href="{{ route('admin.salary') }}" class="btn btn-secondary mx-3">Thoát</a>
                </div>
            </form>
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
