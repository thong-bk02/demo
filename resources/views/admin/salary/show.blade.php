@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="text-center">
            Thông tin Lương
        </h2>
        @foreach ($salarys as $salary)
            <form action="" method="">
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
                            <input type="text" class="form-control" value="{{ $salary->coefficients_salary }}"
                                disabled>
                        </div>
                        <div class="form-group">
                            <label>Số ngày công</label>
                            <input type="text" class="form-control" value="{{ $salary->working_days }}" disabled>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="phone">Phụ cấp</label>
                            <input type="number" class="form-control" name="absence" value="{{ $salary->subsidize }}">
                        </div>
                        <div class="row">
                            <div class="form-group col-6">
                                <label for="email">Tổng thưởng</label>
                                {{-- <input type="number" class="form-control" name="reward" value="{{ $salary->reward }}"> --}}
                                <input type="number" class="form-control" name="reward" value="">
                            </div>
                            <div class="form-group col-6">
                                <label for="email">Tổng phạt</label>
                                {{-- <input type="number" class="form-control" name="discipline" value="{{ $salary->discipline }}"> --}}
                                <input type="number" class="form-control" name="discipline" value="">
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
                            <input type="number" class="form-control" value="{{ $salary->total_money }}" disabled>
                        </div>
                    </div>
                </div>

                <table class="table">
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
                        @foreach ($rads as $rad)
                            <tr class="border-bottom border-dark">
                                <td>
                                    {{ $rad->genre }}
                                </td>
                                <td>
                                    {{ $rad->reasion }}
                                </td>
                                <td>
                                    {{ $rad->money }}
                                </td>
                                <td>
                                    {{ $rad->date_created }}
                                </td>
                                <td>
                                    <a href="{{ route('admin.reward-discipline.show', $rad->user_id) }}"
                                        class="mx-1"><i class="fa-solid fa-eye"></i></a>
                                    <a href="" class="mx-1" onclick="return confirmDelete()"><i
                                            class="fa-solid fa-trash-can"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="mx-lg-5 m-2">
                    <input type="submit" class="btn btn-primary mx-3" value="Lưu">
                    <a href="{{ route('admin.salary') }}" class="btn btn-secondary mx-3">Thoát</a>
                </div>
            </form>
        @endforeach
    </div>
@endsection
