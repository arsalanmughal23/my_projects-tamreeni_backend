

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


@canany(['favourites.index', 'favourites.create', 'favourites.show', 'favourites.edit', 'favourites.destroy'])
    <li class="nav-item">
        <a href="{{ route('favourites.index') }}"
        class="nav-link {{ Request::is('favourites*') ? 'active' : '' }}">
            <p>Favourites</p>
        </a>
    </li>
@endcan


@canany(['meal_categories.index', 'meal_categories.create', 'meal_categories.show', 'meal_categories.edit', 'meal_categories.destroy'])
    <li class="nav-item">
        <a href="{{ route('meal_categories.index') }}"
        class="nav-link {{ Request::is('meal_categories*') ? 'active' : '' }}">
            <p>Meal Categories</p>
        </a>
    </li>
@endcan


@canany(['meals.index', 'meals.create', 'meals.show', 'meals.edit', 'meals.destroy'])
    <li class="nav-item">
        <a href="{{ route('meals.index') }}"
        class="nav-link {{ Request::is('meals*') ? 'active' : '' }}">
            <p>Meals</p>
        </a>
    </li>
@endcan


@canany(['body_parts.index', 'body_parts.create', 'body_parts.show', 'body_parts.edit', 'body_parts.destroy'])
    <li class="nav-item">
        <a href="{{ route('body_parts.index') }}"
        class="nav-link {{ Request::is('body_parts*') ? 'active' : '' }}">
            <p>Body Parts</p>
        </a>
    </li>
@endcan


@canany(['exercise_equipments.index', 'exercise_equipments.create', 'exercise_equipments.show', 'exercise_equipments.edit', 'exercise_equipments.destroy'])
    <li class="nav-item">
        <a href="{{ route('exercise_equipments.index') }}"
        class="nav-link {{ Request::is('exercise_equipments*') ? 'active' : '' }}">
            <p>Exercise Equipments</p>
        </a>
    </li>
@endcan


@canany(['events.index', 'events.create', 'events.show', 'events.edit', 'events.destroy'])
    <li class="nav-item">
        <a href="{{ route('events.index') }}"
        class="nav-link {{ Request::is('events*') ? 'active' : '' }}">
            <p>Events</p>
        </a>
    </li>
@endcan


@canany(['user_events.index', 'user_events.create', 'user_events.show', 'user_events.edit', 'user_events.destroy'])
    <li class="nav-item">
        <a href="{{ route('user_events.index') }}"
        class="nav-link {{ Request::is('user_events*') ? 'active' : '' }}">
            <p>User Events</p>
        </a>
    </li>
@endcan


@canany(['exercises.index', 'exercises.create', 'exercises.show', 'exercises.edit', 'exercises.destroy'])
    <li class="nav-item">
        <a href="{{ route('exercises.index') }}"
        class="nav-link {{ Request::is('exercises*') ? 'active' : '' }}">
            <p>Exercises</p>
        </a>
    </li>
@endcan


@canany(['exercise_equipment_pivots.index', 'exercise_equipment_pivots.create', 'exercise_equipment_pivots.show', 'exercise_equipment_pivots.edit', 'exercise_equipment_pivots.destroy'])
    <li class="nav-item">
        <a href="{{ route('exercise_equipment_pivots.index') }}"
        class="nav-link {{ Request::is('exercise_equipment_pivots*') ? 'active' : '' }}">
            <p>Exercise Equipment Pivots</p>
        </a>
    </li>
@endcan


