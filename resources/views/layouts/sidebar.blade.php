<aside class="main-sidebar sidebar-dark-primary">
    <a href="{{ route('home') }}" class="brand-link">
        <img src="{{ asset('public/image/logo.png') }}" alt="{{ config('app.name') }} Logo"
             class="brand-image" onerror="brokenImageHandler(this);"/>

        <span class="brand-text font-weight-light">{{ config('app.name') }}</span>
    </a>
    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar" data-widget="treeview" role="menu"
                data-accordion="false">

                @role(\App\Models\Role::SUPER_ADMIN)
                    <li class="nav-item">
                        <a href="{{ route('io_generator_builder') }}"
                        class="nav-link {{ Request::is('generator_builder*') ? 'active' : '' }}">
                            <i class="fa fa-building"></i> <span>Generator Builder</span>
                        </a>
                    </li>

                    @if(false)
                        <li class="nav-item">
                            <a href="{{ route('menus.index') }}" class="nav-link {{ Request::is('menus*') ? 'active' : '' }}">
                                <i class="fa fa-list"></i> <span>Menus</span>
                            </a>
                        </li>
                    @endif
                @endrole

                @include('layouts.menu')

                @if(false)
                    @forelse (getMenus() as $menu)
                        @canany([$menu->slug . '.index', $menu->slug . '.create', $menu->slug . '.show', $menu->slug . '.edit', $menu->slug . '.destroy'])
                            <li class="nav-item">
                                <a href="{{ route($menu->slug . '.index') }}" class="nav-link {{ Request::is($menu->slug . '*') ? 'active' : '' }}">
                                    <i class="fa fa-{{ $menu->icon }}"></i><span>{{ $menu->name }}</span>
                                </a>
                            </li>
                        @endcan
                    @empty
                    @endforelse
                @endif
            </ul>
        </nav>
    </div>
</aside>
