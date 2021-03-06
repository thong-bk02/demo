@extends('layouts.app')

@section('content')
    <div class="container">
        
        @include('layouts.message')

        <div class="py-3">
            <a href="{{ route('admin.access-rights.create') }}" class="btn btn-primary">Thêm Quyền</a>
        </div>
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th>Stt</th>
                    <th>Tên chức vụ</th>
                    <th>Quyền truy cập</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($access_rights as $access_right)
                    <tr class="border-bottom border-dark">
                        <th scope="row">
                            {{ $loop->iteration }}
                        </th>
                        <td>
                            {{ $access_right->position_name }}
                        </td>
                        <td  style="max-width:30rem;">
                            {!! $access_right->users == 1 ? '<a class="btn btn-primary btn-sm my-1 disabled">Quản lí nhân sự</a>' : '' !!}
                            {!! $access_right->position == 1 ? '<a class="btn btn-primary btn-sm my-1 disabled">Quản lí chức vụ</a>' : '' !!}
                            {!! $access_right->department == 1 ? '<a class="btn btn-primary btn-sm my-1 disabled">Quản lí phòng ban</a>' : '' !!}
                            {!! $access_right->terms_and_service == 1 ? '<a class="btn btn-primary my-1 btn-sm disabled">Quản lí Nội quy - chế tài</a>' : '' !!}
                            {!! $access_right->event == 1 ? '<a class="btn btn-primary btn-sm my-1 disabled">Quản lí sự kiện</a>' : '' !!}
                            {!! $access_right->salary == 1 ? '<a class="btn btn-primary btn-sm my-1 disabled">Quản lí lương</a>' : '' !!}
                            {!! $access_right->reward_and_disciplines == 1 ? '<a class="btn btn-primary btn-sm my-1 disabled">Thưởng phạt</a>' : '' !!}
                            {!! $access_right->timekeeping == 1 ? '<a class="btn btn-primary btn-sm my-1 disabled">Quản lí chấm công</a>' : '' !!}
                        </td>
                        <td class="text-center" >
                            <a href="{{ route('admin.access-rights.show', $access_right->id) }}" class="mx-1">
                                <i class="fa-solid fa-eye"></i>
                            </a>
                            <a href="" class="mx-1"
                                onclick="return confirmDelete()"><i class="fa-solid fa-trash-can"></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <script>
        function confirmDelete() {
            if (confirm("xóa người nhân viên này ?") == true) {
                return true;
            } else {
                return false;
            }
        }
    </script>
@endsection
