@if (session('success'))
    <div class="alert alert-success" role="alert" id="alert">
        <span>{{ session('success') }}</span>
    </div>
@elseif (session('failed'))
    <div class="alert alert-danger" role="alert" id="alert">
        <span>{{ session('failed') }}</span>
    </div>
@endif
@if (Session::has('success') || Session::has('failed'))
    <script>
        const myTimeout = setTimeout(myGreeting, 3000);

        function myGreeting() {
            document.getElementById("alert").innerHTML = "";
            var alert = document.getElementById("alert");
            alert.classList.remove("alert");
        }
    </script>
@endif
