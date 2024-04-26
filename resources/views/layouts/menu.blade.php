

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


@canany(['contact_requests.index', 'contact_requests.create', 'contact_requests.show', 'contact_requests.edit', 'contact_requests.destroy'])
    <li class="nav-item">
        <a href="{{ route('contact_requests.index') }}"
        class="nav-link {{ Request::is('contact_requests*') ? 'active' : '' }}">
            <p>Contact Requests</p>
        </a>
    </li>
@endcan


@canany(['slots.index', 'slots.create', 'slots.show', 'slots.edit', 'slots.destroy'])
    <li class="nav-item">
        <a href="{{ route('slots.index') }}"
        class="nav-link {{ Request::is('slots*') ? 'active' : '' }}">
            <p>Slots</p>
        </a>
    </li>
@endcan


@canany(['appointments.index', 'appointments.create', 'appointments.show', 'appointments.edit', 'appointments.destroy'])
    <li class="nav-item">
        <a href="{{ route('appointments.index') }}"
        class="nav-link {{ Request::is('appointments*') ? 'active' : '' }}">
            <p>Appointments</p>
        </a>
    </li>
@endcan


@canany(['packages.index', 'packages.create', 'packages.show', 'packages.edit', 'packages.destroy'])
    <li class="nav-item">
        <a href="{{ route('packages.index') }}"
        class="nav-link {{ Request::is('packages*') ? 'active' : '' }}">
            <p>Packages</p>
        </a>
    </li>
@endcan


@canany(['transactions.index', 'transactions.create', 'transactions.show', 'transactions.edit', 'transactions.destroy'])
    <li class="nav-item">
        <a href="{{ route('transactions.index') }}"
        class="nav-link {{ Request::is('transactions*') ? 'active' : '' }}">
            <p>Transactions</p>
        </a>
    </li>
@endcan


@canany(['user_subscriptions.index', 'user_subscriptions.create', 'user_subscriptions.show', 'user_subscriptions.edit', 'user_subscriptions.destroy'])
    <li class="nav-item">
        <a href="{{ route('user_subscriptions.index') }}"
        class="nav-link {{ Request::is('user_subscriptions*') ? 'active' : '' }}">
            <p>User Subscriptions</p>
        </a>
    </li>
@endcan


@canany(['meal_types.index', 'meal_types.create', 'meal_types.show', 'meal_types.edit', 'meal_types.destroy'])
    <li class="nav-item">
        <a href="{{ route('meal_types.index') }}"
        class="nav-link {{ Request::is('meal_types*') ? 'active' : '' }}">
            <p>Meal Types</p>
        </a>
    </li>
@endcan


@canany(['workout_days.index', 'workout_days.create', 'workout_days.show', 'workout_days.edit', 'workout_days.destroy'])
    <li class="nav-item">
        <a href="{{ route('workout_days.index') }}"
        class="nav-link {{ Request::is('workout_days*') ? 'active' : '' }}">
            <p>Workout Days</p>
        </a>
    </li>
@endcan


@canany(['workout_day_exercises.index', 'workout_day_exercises.create', 'workout_day_exercises.show', 'workout_day_exercises.edit', 'workout_day_exercises.destroy'])
    <li class="nav-item">
        <a href="{{ route('workout_day_exercises.index') }}"
        class="nav-link {{ Request::is('workout_day_exercises*') ? 'active' : '' }}">
            <p>Workout Day Exercises</p>
        </a>
    </li>
@endcan


@canany(['workout_plans.index', 'workout_plans.create', 'workout_plans.show', 'workout_plans.edit', 'workout_plans.destroy'])
    <li class="nav-item">
        <a href="{{ route('workout_plans.index') }}"
        class="nav-link {{ Request::is('workout_plans*') ? 'active' : '' }}">
            <p>Workout Plans</p>
        </a>
    </li>
@endcan


@canany(['nutrition_plans.index', 'nutrition_plans.create', 'nutrition_plans.show', 'nutrition_plans.edit', 'nutrition_plans.destroy'])
    <li class="nav-item">
        <a href="{{ route('nutrition_plans.index') }}"
        class="nav-link {{ Request::is('nutrition_plans*') ? 'active' : '' }}">
            <p>Nutrition Plans</p>
        </a>
    </li>
@endcan


@canany(['nutrition_plan_days.index', 'nutrition_plan_days.create', 'nutrition_plan_days.show', 'nutrition_plan_days.edit', 'nutrition_plan_days.destroy'])
    <li class="nav-item">
        <a href="{{ route('nutrition_plan_days.index') }}"
        class="nav-link {{ Request::is('nutrition_plan_days*') ? 'active' : '' }}">
            <p>Nutrition Plan Days</p>
        </a>
    </li>
@endcan


@canany(['nutrition_plan_day_meals.index', 'nutrition_plan_day_meals.create', 'nutrition_plan_day_meals.show', 'nutrition_plan_day_meals.edit', 'nutrition_plan_day_meals.destroy'])
    <li class="nav-item">
        <a href="{{ route('nutrition_plan_day_meals.index') }}"
        class="nav-link {{ Request::is('nutrition_plan_day_meals*') ? 'active' : '' }}">
            <p>Nutrition Plan Day Meals</p>
        </a>
    </li>
@endcan


@canany(['questions.index', 'questions.create', 'questions.show', 'questions.edit', 'questions.destroy'])
    <li class="nav-item">
        <a href="{{ route('questions.index') }}"
        class="nav-link {{ Request::is('questions*') ? 'active' : '' }}">
            <p>Questions</p>
        </a>
    </li>
@endcan


@canany(['options.index', 'options.create', 'options.show', 'options.edit', 'options.destroy'])
    <li class="nav-item">
        <a href="{{ route('options.index') }}"
        class="nav-link {{ Request::is('options*') ? 'active' : '' }}">
            <p>Options</p>
        </a>
    </li>
@endcan


