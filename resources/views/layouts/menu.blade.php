

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
@canany(['faqs.index', 'faqs.create', 'faqs.show', 'faqs.edit', 'faqs.destroy'])
    <li class="nav-item">
        <a href="{{ route('faqs.index') }}"
        class="nav-link {{ Request::is('faqs*') ? 'active' : '' }}">
            <p>Faqs</p>
        </a>
    </li>
@endcan


@canany(['user_details.index', 'user_details.create', 'user_details.show', 'user_details.edit', 'user_details.destroy'])
    <li class="nav-item">
        <a href="{{ route('user_details.index') }}"
        class="nav-link {{ Request::is('user_details*') ? 'active' : '' }}">
            <p>User Details</p>
        </a>
    </li>
@endcan


@canany(['wellness_tips.index', 'wellness_tips.create', 'wellness_tips.show', 'wellness_tips.edit', 'wellness_tips.destroy'])
    <li class="nav-item">
        <a href="{{ route('wellness_tips.index') }}"
        class="nav-link {{ Request::is('wellness_tips*') ? 'active' : '' }}">
            <p>Wellness Tips</p>
        </a>
    </li>
@endcan


