<li class="nav-item">
    <a href="{{ route('users') }}" class="nav-link {{ Request::is('users') ? 'active' : '' }}">
        <i class="nav-icon fa-solid fa-users"></i>
        <p>Danh sách nhân sự</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('position-department') }}" class="nav-link {{ Request::is('position-department*') ? 'active' : '' }}">
        <i class="nav-icon fa-solid fa-address-card"></i>
        <p>Chức vụ / Phòng ban</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('timekeeping') }}" class="nav-link {{ Request::is('timekeeping*') ? 'active' : '' }}">
        <i class="nav-icon fa-solid fa-calendar-plus"></i>
        <p>Chấm công</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('reward.discipline') }}" class="nav-link {{ Request::is('reward-and-discipline*') ? 'active' : '' }}">
        <i class="nav-icon fa-solid fa-sack-dollar"></i>
        <p>Danh sách thưởng-phạt</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('salary') }}" class="nav-link {{ Request::is('salary*') ? 'active' : '' }}">
        <i class="nav-icon fa-solid fa-money-bill-1-wave"></i>
        <p>Lương tháng</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('event') }}" class="nav-link {{ Request::is('event*') ? 'active' : '' }}">
        <i class="nav-icon fa-solid fa-calendar-days"></i>
        <p>Sự kiện</p>
    </a>
</li>
