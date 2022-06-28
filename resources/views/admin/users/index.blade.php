@extends('layouts.app')

@section('content')
    <div class="container">
        @if (session('success'))
            <div class="alert alert-success" role="alert">
                <span>{{ session('success') }}</span>
            </div>
        @elseif (session('failed'))
            <div class="alert alert-error" role="alert">
                <span>{{ session('failed') }}</span>
            </div>
        @endif
        <table class="table">
            <thead class="thead-light">
                <tr>
                    <th scope="col">Họ và Tên</th>
                    <th scope="col">Chức vụ</th>
                    <th scope="col">Phòng ban</th>
                    <th scope="col">Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <form action="{{ route('admin.users.search') }}" method="post">
                        @csrf
                        <td>
                            <input type="text" name="name" id="user_name" placeholder="Họ và tên"
                                value="@if (isset($input['name'])) {{ $input['name'] }} @endif"
                                class="form-control" autocomplete = "off">
                            <p  id="user_list"></p>
                        </td>
                        <td>
                            <select class="form-control" name="position">
                                <option value="0">tất cả</option>
                                @foreach ($positions as $position)
                                    <option value="{{ $position->id }}"
                                        @if (isset($input['position'])) {{ $position->id == $input['position'] ? 'selected' : '' }} @endif>
                                        {{ $position->position_name }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <select class="form-control" name="department">
                                <option value="0">tất cả</option>
                                @foreach ($departments as $department)
                                    <option value="{{ $department->id }}"
                                        @if (isset($input['department'])) {{ $department->id == $input['department'] ? 'selected' : '' }} @endif>
                                        {{ $department->department }}</option>
                                @endforeach
                            </select>

                        </td>
                        <td>
                            <button type="submit" class="btn btn-primary">Search</button>
                            <a href="{{ route('admin.user.create') }}" class="btn btn-primary">Thêm nhân sự</a>
                        </td>
                    </form>
                </tr>
            </tbody>
        </table>

        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Mã nhân viên</th>
                    <th scope="col">Tên nhân viên</th>
                    <th scope="col">Chức vụ</th>
                    <th scope="col">Phòng ban</th>
                    <th scope="col">Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr class="border-bottom border-dark">
                        <th scope="row">{{ $user->user_id }}</th>
                        <td>
                            {{ $user->user_code }}
                        </td>
                        <td>
                            {{ $user->name }}
                        </td>
                        <td>
                            {{ $user->position_name }}
                        </td>
                        <td>
                            {{ $user->department }}
                        </td>
                        <td>
                            <a href="{{ route('admin.user.show', $user->user_id) }}" class="mx-1"><i
                                    class="fa-solid fa-eye"></i></a>
                            <a href="{{ route('admin.user.delete', $user->user_id) }}" class="mx-1"
                                onclick="return confirmDelete()"><i class="fa-solid fa-trash-can"></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            {{ csrf_field() }}
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

    <script>
        $(document).ready(function() {

            $('#user_name').keyup(function() { //bắt sự kiện keyup khi người dùng gõ từ khóa tim kiếm
                var query = $(this).val(); //lấy gía trị ng dùng gõ
                if (query != '') //kiểm tra khác rỗng thì thực hiện đoạn lệnh bên dưới
                {
                    var _token = $('input[name="_token"]').val(); // token để mã hóa dữ liệu
                    $.ajax({
                        url: "{{ route('admin.users.searchAjax') }}", // đường dẫn khi gửi dữ liệu đi 'search' là tên route mình đặt bạn mở route lên xem là hiểu nó là cái j.
                        method: "POST", // phương thức gửi dữ liệu.
                        data: {
                            query: query,
                            _token: _token
                        },
                        success: function(data) { //dữ liệu nhận về
                            $('#user_list').fadeIn();
                            $('#user_list').html(
                            data); //nhận dữ liệu dạng html và gán vào cặp thẻ có id là countryList
                        }
                    });
                }
            });

            $(document).on('click', 'li', function() {
                $('#user_name').val($(this).text());
                $('#user_list').fadeOut();
            });

        });
    </script>
@endsection
