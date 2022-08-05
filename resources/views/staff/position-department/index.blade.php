@extends('staff.layouts.app')

@section('title')
    <title>Danh sách phòng ban</title>
@endsection

@section('content')
    @include('layouts.message')
    <div class="row">
        <div class="col-6">
            <div class="text-center h2 py-3">Danh sách chức vụ</div>
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Stt</th>
                        <th scope="col">Mã chức vụ</th>
                        <th scope="col">Tên chức vụ</th>
                        <th scope="col">Ngày tạo</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($positions as $position)
                        <tr class="border-bottom border-dark">
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>
                                {{ $position->position_code }}
                            </td>
                            <td>
                                {{ $position->position_name }}
                            </td>
                            <td>
                                {{ date('d/m/Y', strtotime($position->created_at)) }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-6">
            <div class="text-center h2 py-3">Danh sách phòng ban</div>
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Stt</th>
                        <th scope="col">Mã phòng ban</th>
                        <th scope="col">Tên phòng ban</th>
                        <th scope="col">Ngày tạo</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($departments as $department)
                        <tr class="border-bottom border-dark">
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>
                                {{ $department->department_code }}
                            </td>
                            <td>
                                {{ $department->department }}
                            </td>
                            <td>
                                {{ date('d/m/Y', strtotime($department->created_at)) }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
