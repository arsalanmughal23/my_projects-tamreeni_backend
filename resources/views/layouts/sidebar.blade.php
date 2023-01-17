<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="{{ url('/home') }}" class="brand-link">
        <img src="{{ asset('image/user.png') }}" alt="{{ config('app.name') }} Logo"
            class="brand-image img-circle elevation-3">
        <span class="brand-text font-weight-light">{{ config('app.name') }}</span>
    </a>
    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">

                @role('Super-Admin')
                    <li class="nav-item">
                        <a href="{{ route('io_generator_builder') }}"
                            class="nav-link {{ Request::is('generator_builder*') ? 'active' : '' }}">
                            <i class="fa fa-building"></i> <span>Generator Builder</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('users.index') }}" class="nav-link {{ Request::is('users*') ? 'active' : '' }}">
                            <i class="fa fa-users"></i> <span>Users</span>
                        </a>
                    </li>


                    <li class="nav-item">
                        <a href="{{ route('roles.index') }}" class="nav-link {{ Request::is('roles*') ? 'active' : '' }}">
                            <i class="fa fa-tasks"></i> <span>Roles</span>
                        </a>
                    </li>


                    <li class="nav-item">
                        <a href="{{ route('permissions.index') }}"
                            class="nav-link {{ Request::is('permissions*') ? 'active' : '' }}">
                            <i class="fa fa-lock"></i> <span>Permissions</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('menus.index') }}" class="nav-link {{ Request::is('menus*') ? 'active' : '' }}">
                            <i class="fa fa-list"></i> <span>Menus</span>
                        </a>
                    </li>
                @endrole
                @role('admin')
                    <li class="nav-item">
                        <a href="{{ route('users.index') }}" class="nav-link {{ Request::is('users*') ? 'active' : '' }}">
                            <i class="fa fa-users"></i> <span>Users</span>
                        </a>
                    </li>
                @endrole


                {{-- @include('layouts.menu') --}}

                @forelse (getMenus() as $menu)
                    @canany([$menu->slug . '.index', $menu->slug . '.create', $menu->slug . '.show', $menu->slug .
                        '.edit', $menu->slug . '.destroy'])
                        <li class="nav-item">
                            <a href="{{ route($menu->slug . '.index') }}"
                                class="nav-link {{ Request::is($menu->slug . '*') ? 'active' : '' }}">
                                <i class="fa fa-{{ $menu->icon }}"></i> <span>{{ $menu->name }}</span>
                            </a>
                        </li>
                    @endcan
                @empty
                @endforelse
            </ul>
        </nav>
    </div>
</aside>
