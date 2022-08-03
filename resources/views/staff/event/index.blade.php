@extends('staff.layouts.app')

@section('title')
    <title>Danh sách sự kiện</title>
@endsection

@section('content')
    <div class="container">
        @include('layouts.message')

        <div class="text-center h2 py-2">Danh Sách các sự kiện</div>

        <table class="table table-hover table-sm table-bordered ">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Stt</th>
                    <th scope="col">Tên sự kiện</th>
                    <th scope="col">Nội dung sự kiện</th>
                    <th scope="col">Ngày bắt đầu</th>
                    <th scope="col">Ngày kết thúc</th>
                    <th scope="col">Trạng thái</th>
                </tr>
            </thead>
            @if (blank($data_event))
            <tbody>
                <tr>
                    <th colspan="6" class="text-center">Không có sự kiện nào !</th>
                </tr>
            </tbody>
            @else
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
                        </tr>
                    @endforeach
                </tbody>
            @endif
        </table>

        <div id="pagination">
            {{ $data_event->links() }}
        </div>
    </div>
@endsection
