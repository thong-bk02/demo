@extends('layouts.app')

@section('content')
    <div class="container">
        @include('layouts.message')

        <div class="text-center h2 py-2">Danh Sách các sự kiện</div>
        <a href="" class="btn btn-primary mb-2" data-toggle="modal" data-target="#modalAddEvent">Thêm sự kiện</a>
        <div class="modal fade" id="modalAddEvent" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <form action="{{ route('admin.event.create') }}" method="post">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="event_name">Tên sự kiện</label>
                                        <textarea name="event_name" class="form-control" required></textarea>
                                    </div>

                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="event_content">Nội dung sự kiện</label>
                                        <textarea name="event_content" class="form-control" required></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="start_date">Ngày bắt đầu</label>
                                        <input type="date" class="form-control" name="start_date" value=""
                                            required>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="end_date">Ngày kết thúc</label>
                                        <input type="date" class="form-control" name="end_date" value="" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                            <input type="submit" class="btn btn-primary" value="Lưu">
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <table class="table table-hover table-sm">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Stt</th>
                    <th scope="col">Tên sự kiện</th>
                    <th scope="col">Nội dung sự kiện</th>
                    <th scope="col">Ngày bắt đầu</th>
                    <th scope="col">Ngày kết thúc</th>
                    <th scope="col">Trạng thái</th>
                    <th scope="col">Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data_event as $event)
                    <tr class="border-bottom border-dark">
                        <th scope="row">
                            {{ $loop->iteration }}
                        </th>
                        <td>
                            {{ $event->event_name }}
                        </td>
                        <td>
                            {{ $event->event_content }}
                        </td>
                        <td>
                            {{ date('d/m/Y', strtotime($event->start_date)) }}
                        </td>
                        <td>
                            {{ date('d/m/Y', strtotime($event->end_date)) }}
                        </td>
                        <td>
                            @if ((strtotime(date('Y-m-d')) >= strtotime($event->start_date)) &
                                (strtotime(date('Y-m-d')) <= strtotime($event->end_date)))
                                <span class="badge badge-success">đang thực hiện</span>
                            @elseif (strtotime(date('Y-m-d')) < strtotime($event->start_date))
                                <span class="badge badge-info">chưa thực hiện</span>
                            @else
                                <span class="badge badge-primary">đã hoàn thành</span>
                            @endif
                        </td>
                        <td>
                            <a href="" class="mx-1" data-toggle="modal"
                                data-target="#exampleModalCenter{{ $event->id }}">
                                <i class="fa-solid fa-eye"></i>
                            </a>
                            <div class="modal fade" id="exampleModalCenter{{ $event->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <form action="{{ route('admin.event.update', $event->id) }}" method="POST">
                                            @csrf
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label for="event_name">Tên sự kiện</label>
                                                            <textarea name="event_name" class="form-control">{{ $event->event_name }}</textarea>
                                                        </div>

                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label for="event_content">Nội dung sự kiện</label>
                                                            <textarea name="event_content" class="form-control">{{ $event->event_content }}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-4">
                                                        <div class="form-group">
                                                            <label for="start_date">Ngày bắt đầu</label>
                                                            <input type="date" class="form-control" name="start_date"
                                                                value="{{ $event->start_date }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-4">
                                                        <div class="form-group">
                                                            <label for="end_date">Ngày kết thúc</label>
                                                            <input type="date" class="form-control" name="end_date"
                                                                value="{{ $event->end_date }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-4">
                                                        <label for="status">Trạng thái</label>
                                                        <select class="form-control" name="status" id="status">
                                                            <option value="1"
                                                                {{ $event->status == 1 ? 'selected' : '' }}>
                                                                mở
                                                            </option>
                                                            <option value="2"
                                                                {{ $event->status == 2 ? 'selected' : '' }}>
                                                                đóng
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Đóng</button>
                                                <input type="submit" class="btn btn-primary" value="Cập nhật">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <a href="{{ route('admin.event.delete', $event->id) }}" class="mx-1"
                                onclick="return confirmDelete()">
                                <i class="fa-solid fa-trash-can"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div id="pagination">
            {{ $data_event->links() }}
        </div>
    </div>
    <script>
        function confirmDelete() {
            if (confirm("xóa sự kiện này ?") == true) {
                return true;
            } else {
                return false;
            }
        }
    </script>
@endsection
