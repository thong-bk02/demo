<li class="nav-item">
    <a href="{{ route('home') }}" class="nav-link {{ Request::is('home') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Trang chủ</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('admin.user') }}" class="nav-link {{ Request::is('admin/users*') ? 'active' : '' }}">
        <i class="nav-icon fa-solid fa-users"></i>
        <p>Quản lí nhân sự</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('admin.position') }}" class="nav-link {{ Request::is('admin/position*') ? 'active' : '' }}">
        <i class="nav-icon fa-solid fa-address-card"></i>
        <p>Quản lí chức vụ</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('admin.department') }}" class="nav-link {{ Request::is('admin/department*') ? 'active' : '' }}">
        <i class="nav-icon fa-solid fa-city"></i>
        <p>Quản lí phòng ban</p>
    </a>
</li>

{{-- <li class="nav-item">
    <a href="{{ route('admin.access-rights') }}" class="nav-link {{ Request::is('admin/access-rights*') ? 'active' : '' }}">
        <i class="nav-icon fa-solid fa-eye-low-vision"></i>
        <p>Quản lí quyền</p>
    </a>
</li> --}}
{{-- 
<li class="nav-item" id="reward-discipline">
    <a class="nav-link accordion-toggle collapsed" data-toggle="collapse" data-target="#list">
        <i class="nav-icon fa-solid fa-sack-dollar"></i>
        <p>Quản lí thưởng-phạt</p>
    </a>
    <div id="list" class="collapse d-block">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ Request::is('admin/reward-discipline/reasion*') ? 'active' : '' }}"
                    href="{{ route('admin.reasion') }}">
                    <i class="fa-regular fa-circle pl-3 pr-2"></i>Lý do</a>
            </li>
            <li class="nav-item">
                <a class="nav-link pl-5 {{ Request::is('admin/department*') ? 'active' : '' }}"
                    href="#">Transazioni</a>
            </li>
            <li class="nav-item">
                <a class="nav-link pl-5 {{ Request::is('admin/department*') ? 'active' : '' }}"
                    href="#">Transazioni</a>
            </li>
        </ul>
    </div>
</li>
@if (Request::is('admin/reward-discipline/reasion*'))
    <script>
        $(function() {
            $(document).on("click", "#reward-discipline", function() {
                if ($("#list").hasClass("d-block")) {
                    $("#list").removeClass("d-block");
                }
            });
        });
    </script>
@endif --}}


<li class="nav-item">
    <a href="{{ route('admin.timekeeping') }}"
        class="nav-link {{ Request::is('admin/timekeeping*') ? 'active' : '' }}">
        <i class="nav-icon fa-solid fa-calendar-plus"></i>
        <p>Quản lí chấm công</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('admin.reward-discipline') }}"
        class="nav-link {{ Request::is('admin/reward-discipline*') ? 'active' : '' }}">
        <i class="nav-icon fa-solid fa-sack-dollar"></i>
        <p>Quản lí thưởng-phạt</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('admin.salary') }}" class="nav-link {{ Request::is('admin/salary*') ? 'active' : '' }}">
        <i class="nav-icon fa-solid fa-money-bill-1-wave"></i>
        <p>Quản lí lương</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('admin.event') }}" class="nav-link {{ Request::is('admin/event*') ? 'active' : '' }}">
        <i class="nav-icon fa-solid fa-calendar-days"></i>
        <p>Sự kiện</p>
    </a>
</li>

{{-- <li class="nav-item">
    <a href="" class="nav-link {{ Request::is('admin/calendar*') ? 'active' : '' }}">
        <i class="nav-icon fa-solid fa-scale-balanced"></i>
        <p>Nội quy, Chế tài</p>
    </a>
</li> --}}
