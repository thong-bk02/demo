<li class="nav-item">
    <a href="" class="nav-link {{ Request::is('admin') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Dashbroad</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('admin.user') }}" class="nav-link {{ Request::is('admin/users') ? 'active' : '' }}">
        <i class="nav-icon fa-solid fa-users"></i>
        <p>Quản lí nhân sự</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('admin.position') }}" class="nav-link {{ Request::is('admin/position') ? 'active' : '' }}">
        <i class="nav-icon fa-solid fa-address-card"></i>
        <p>Quản lí chức vụ</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('admin.department') }}" class="nav-link {{ Request::is('admin/department') ? 'active' : '' }}">
        <i class="nav-icon fa-solid fa-city"></i>
        <p>Quản lí phòng ban</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('admin.access-rights') }}" class="nav-link {{ Request::is('admin/access-rights') ? 'active' : '' }}">
        <i class="nav-icon fa-solid fa-eye-low-vision"></i>
        <p>Quản lí quyền</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('admin.projects') }}" class="nav-link {{ Request::is('admin/projects') ? 'active' : '' }}">
        <i class="nav-icon fa-solid fa-diagram-project"></i>
        <p>Quản lí dự án</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('admin.task-lists') }}" class="nav-link {{ Request::is('admin/task-lists') ? 'active' : '' }}">
        <i class="nav-icon fa-solid fa-list-check"></i>
        <p>Quản lí công việc</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('admin.timekeeping') }}" class="nav-link {{ Request::is('admin/timekeeping') ? 'active' : '' }}">
        <i class="nav-icon fa-solid fa-calendar-plus"></i>
        <p>Quản lí chấm công</p>
    </a>
</li>

<li class="nav-item">
    <a href="" class="nav-link {{ Request::is('admin/fine') ? 'active' : '' }}">
        <i class="nav-icon fa-solid fa-sack-dollar"></i>
        <p>Quản lí thưởng-phạt</p>
    </a>
</li>

<li class="nav-item">
    <a href="" class="nav-link {{ Request::is('admin/salary') ? 'active' : '' }}">
        <i class="nav-icon fa-solid fa-money-bill-1-wave"></i>
        <p>Quản lí lương</p>
    </a>
</li>

<li class="nav-item">
    <a href="" class="nav-link {{ Request::is('admin/calendar') ? 'active' : '' }}">
        <i class="nav-icon fa-solid fa-calendar-days"></i>
        <p>Sự kiện</p>
    </a>
</li>