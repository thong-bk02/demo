@extends('staff.layouts.app')

@section('title')
    <title>Danh sách thưởng phạt</title>
@endsection

@section('content')
    <div class="container">
        @include('layouts.message')
        <table class="table">
            <thead class="thead-light">
                <tr>
                    <th scope="col" class="w-25">Tháng</th>
                    <th scope="col">Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <form id="searchform" name="searchform" method="post">
                        <td>
                            <input type="month" name="month" class="form-control"
                                value="">
                        </td>
                        <td>
                            <a class='btn btn-primary' href='{{ url('reward-and-discipline') }}' id='search_btn'>
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </a>
                        </td>
                    </form>
                </tr>
            </tbody>
        </table>

        {{-- Kết quả tìm kiếm --}}
        <div id="pagination_data">
            @include('staff.reward-discipline.index_page_data', [
                'decisions' => $decisions,
            ])
        </div>
    </div>

    {{-- Search --}}
    <script>
        $(function() {
            $(document).on("click", "#pagination a,#search_btn", function() {
                var url = $(this).attr("href");
                var append = url.indexOf("?") == -1 ? "?" : "&";
                var finalURL = url + append + $("#searchform").serialize();

                event.preventDefault();
                $.get(finalURL, function(data) {
                    $("#pagination_data").html(data);
                });
                return false;
            })

        });
    </script>
@endsection
