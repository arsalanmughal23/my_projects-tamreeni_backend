<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="{{ url('/home') }}" class="brand-link">
        <img src="https://assets.infyom.com/logo/blue_logo_150x150.png"
             alt="{{ config('app.name') }} Logo"
             class="brand-image img-circle elevation-3">
        <span class="brand-text font-weight-light">{{ config('app.name') }}</span>
    </a>
    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                @role('Super-Admin')
                    <li class="nav-item">
                        <a href="{{ route('io_generator_builder') }}"
                        class="nav-link {{ Request::is('generator_builder*') ? 'active' : '' }}">
                            <p>Generator Builder</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('users.index') }}"
                        class="nav-link {{ Request::is('users*') ? 'active' : '' }}">
                            <p>Users</p>
                        </a>
                    </li>


                    <li class="nav-item">
                        <a href="{{ route('roles.index') }}"
                        class="nav-link {{ Request::is('roles*') ? 'active' : '' }}">
                            <p>Roles</p>
                        </a>
                    </li>


                    <li class="nav-item">
                        <a href="{{ route('permissions.index') }}"
                        class="nav-link {{ Request::is('permissions*') ? 'active' : '' }}">
                            <p>Permissions</p>
                        </a>
                    </li>
                @endrole

                @include('layouts.menu')
            </ul>
        </nav>
    </div>
</aside>
