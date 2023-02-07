

@canany(['pages.index', 'pages.create', 'pages.show', 'pages.edit', 'pages.destroy'])
    <li class="nav-item">
        <a href="{{ route('pages.index') }}"
        class="nav-link {{ Request::is('pages*') ? 'active' : '' }}">
            <p>Pages</p>
        </a>
    </li>
@endcan


@canany(['settings.index', 'settings.create', 'settings.show', 'settings.edit', 'settings.destroy'])
    <li class="nav-item">
        <a href="{{ route('settings.index') }}"
        class="nav-link {{ Request::is('settings*') ? 'active' : '' }}">
            <p>Settings</p>
        </a>
    </li>
@endcan


@canany(['constants.index', 'constants.create', 'constants.show', 'constants.edit', 'constants.destroy'])
    <li class="nav-item">
        <a href="{{ route('constants.index') }}"
        class="nav-link {{ Request::is('constants*') ? 'active' : '' }}">
            <p>Constants</p>
        </a>
    </li>
@endcan


@canany(['stacks.index', 'stacks.create', 'stacks.show', 'stacks.edit', 'stacks.destroy'])
    <li class="nav-item">
        <a href="{{ route('stacks.index') }}"
        class="nav-link {{ Request::is('stacks*') ? 'active' : '' }}">
            <p>Stacks</p>
        </a>
    </li>
@endcan


@canany(['employees.index', 'employees.create', 'employees.show', 'employees.edit', 'employees.destroy'])
    <li class="nav-item">
        <a href="{{ route('employees.index') }}"
        class="nav-link {{ Request::is('employees*') ? 'active' : '' }}">
            <p>Employees</p>
        </a>
    </li>
@endcan


