@extends('staff.layouts.app')

@section('content')
    <div class="container">
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
                            <input type="month" name="month" class="form-control" value="{{ date('Y-m') }}">
                        </td>
                        <td>
                            <a class='btn btn-primary' href='{{ url('salary') }}' id='search_btn'>
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </a>
                        </td>
                    </form>
                </tr>
            </tbody>
        </table>

        {{-- Kết quả tìm kiếm --}}
        <div id="data">
            
        </div>
    </div>

    <script>
        $(function() {
            var url = $("#search_btn").attr("href");
            var finalURL = url +"?" + $("#searchform").serialize();
            $.get(finalURL, function(data) {
                $("#data").html(data);
            });
            
            $(document).on("click", "#search_btn", function() {
                var url = $(this).attr("href");
                var finalURL = url +"?" + $("#searchform").serialize();

                event.preventDefault();
                $.get(finalURL, function(data) {
                    $("#data").html(data);
                });
                return false;
            })

        });
    </script>
@endsection
