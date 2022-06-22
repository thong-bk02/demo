@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="mb-4">
            Thêm mới quyền truy cập cho
        </h2>
        <form action="" method="post">
            @csrf
            <div style="margin-left: 3rem; margin-right:3rem;">
                <div class="form-group">
                    <label>Chức vụ</label>
                    <select class="form-control w-50" name="position">
                        @foreach ($positions as $position)
                            <option value="{{ $position->id }}" class="text-center">
                                {{ $position->position }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row mx-lg-5 mx-2">
                <div class="col-sm-6">
                    <div class="form-group border border-info rounded">
                        <div class="ml-3"><label for="name">Quản lí nhân viên</label></div>
                        <div class="form-check form-check-inline ml-3">
                            <input class="form-check-input" type="radio" name="users" id="user1" value="1">
                            <label class="form-check-label" for="user1">cho phép</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="users" id="user2" value="0">
                            <label class="form-check-label" for="user2">không cho phép</label>
                        </div>
                    </div>

                    <div class="form-group border border-info rounded">
                        <div class="ml-3"><label for="name">Quản lí chức vụ</label></div>
                        <div class="form-check form-check-inline ml-3">
                            <input class="form-check-input" type="radio" name="position" id="position1" value="1">
                            <label class="form-check-label" for="position1">cho phép</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="position" id="position2" value="0">
                            <label class="form-check-label" for="position2">không cho phép</label>
                        </div>
                    </div>
                    
                    <div class="form-group border border-info rounded">
                        <div class="ml-3"><label for="name">Quản lí phòng ban</label></div>
                        <div class="form-check form-check-inline ml-3">
                            <input class="form-check-input" type="radio" name="department" id="user1" value="1">
                            <label class="form-check-label" for="user1">cho phép</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="department" id="user2" value="0">
                            <label class="form-check-label" for="user2">không cho phép</label>
                        </div>
                    </div>

                    <div class="form-group border border-info rounded">
                        <div class="ml-3"><label for="name">Quản lí chính sách và điều khoản</label></div>
                        <div class="form-check form-check-inline ml-3">
                            <input class="form-check-input" type="radio" name="terms_and_service" id="user1" value="1">
                            <label class="form-check-label" for="user1">cho phép</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="terms_and_service" id="user2" value="0">
                            <label class="form-check-label" for="user2">không cho phép</label>
                        </div>
                    </div>

                    <div class="form-group border border-info rounded">
                        <div class="ml-3"><label for="name">Quản lí sự kiện</label></div>
                        <div class="form-check form-check-inline ml-3">
                            <input class="form-check-input" type="radio" name="event" id="user1" value="1">
                            <label class="form-check-label" for="user1">cho phép</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="event" id="user2" value="0">
                            <label class="form-check-label" for="user2">không cho phép</label>
                        </div>
                    </div>

                    <div class="form-group border border-info rounded">
                        <div class="ml-3"><label for="name">Quản lí lương</label></div>
                        <div class="form-check form-check-inline ml-3">
                            <input class="form-check-input" type="radio" name="salary" id="user1" value="1">
                            <label class="form-check-label" for="user1">cho phép</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="salary" id="user2" value="0">
                            <label class="form-check-label" for="user2">không cho phép</label>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group border border-info rounded">
                        <div class="ml-3"><label for="name">Quản lí tăng ca</label></div>
                        <div class="form-check form-check-inline ml-3">
                            <input class="form-check-input" type="radio" name="overtime" id="user1" value="1">
                            <label class="form-check-label" for="user1">cho phép</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="overtime" id="user2" value="0">
                            <label class="form-check-label" for="user2">không cho phép</label>
                        </div>
                    </div>

                    <div class="form-group border border-info rounded">
                        <div class="ml-3"><label for="name">Quản lí vắng mặt</label></div>
                        <div class="form-check form-check-inline ml-3">
                            <input class="form-check-input" type="radio" name="absence" id="user1" value="1">
                            <label class="form-check-label" for="user1">cho phép</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="absence" id="user2" value="0">
                            <label class="form-check-label" for="user2">không cho phép</label>
                        </div>
                    </div>
                    
                    <div class="form-group border border-info rounded">
                        <div class="ml-3"><label for="name">Quản lí chấm công</label></div>
                        <div class="form-check form-check-inline ml-3">
                            <input class="form-check-input" type="radio" name="timekeeping" id="user1" value="1">
                            <label class="form-check-label" for="user1">cho phép</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="timekeeping" id="user2" value="0">
                            <label class="form-check-label" for="user2">không cho phép</label>
                        </div>
                    </div>

                    <div class="form-group border border-info rounded">
                        <div class="ml-3"><label for="name">Quản lí thưởng phạt</label></div>
                        <div class="form-check form-check-inline ml-3">
                            <input class="form-check-input" type="radio" name="reward_and_disciplines" id="user1" value="1">
                            <label class="form-check-label" for="user1">cho phép</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="reward_and_disciplines" id="user2" value="0">
                            <label class="form-check-label" for="user2">không cho phép</label>
                        </div>
                    </div>

                    <div class="form-group border border-info rounded">
                        <div class="ml-3"><label for="name">Quản lí dự án</label></div>
                        <div class="form-check form-check-inline ml-3">
                            <input class="form-check-input" type="radio" name="project" id="user1" value="1">
                            <label class="form-check-label" for="user1">cho phép</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="project" id="user2" value="0">
                            <label class="form-check-label" for="user2">không cho phép</label>
                        </div>
                    </div>

                    <div class="form-group border border-info rounded">
                        <div class="ml-3"><label for="name">Quản lí công việc</label></div>
                        <div class="form-check form-check-inline ml-3">
                            <input class="form-check-input" type="radio" name="task_list" id="user1" value="1">
                            <label class="form-check-label" for="user1">cho phép</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="task_list" id="user2" value="0">
                            <label class="form-check-label" for="user2">không cho phép</label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mx-lg-5 m-2">
                <input type="submit" class="btn btn-primary mx-3" value="Lưu">
                <a href="{{ route('admin.access-rights') }}" class="btn btn-secondary mx-3">Thoát</a>
            </div>

        </form>

    </div>
@endsection
