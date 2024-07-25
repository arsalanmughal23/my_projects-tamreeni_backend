@canany(['pages.index', 'pages.create', 'pages.show', 'pages.edit', 'pages.destroy'])
    <li class="nav-item">
        <a href="{{ route('pages.index') }}"
        class="nav-link {{ Request::is('pages*') ? 'active' : '' }}">
            <i class="fa fa-file"></i><p>Pages</p>
        </a>
    </li>
@endcan

@canany(['settings.index', 'settings.create', 'settings.show', 'settings.edit', 'settings.destroy'])
    <li class="nav-item">
        <a href="{{ route('settings.index') }}"
        class="nav-link {{ Request::is('settings*') ? 'active' : '' }}">
            <i class="fa fa-cog"></i><p>Settings</p>
        </a>
    </li>
@endcan

@canany(['constants.index', 'constants.create', 'constants.show', 'constants.edit', 'constants.destroy'])
    <li class="nav-item">
        <a href="{{ route('constants.index') }}"
        class="nav-link {{ Request::is('constants*') ? 'active' : '' }}">
            <i class="fa fa-key"></i><p>Constants</p>
        </a>
    </li>
@endcan

@canany(['faqs.index', 'faqs.create', 'faqs.show', 'faqs.edit', 'faqs.destroy'])
    <li class="nav-item">
        <a href="{{ route('faqs.index') }}"
        class="nav-link {{ Request::is('faqs*') ? 'active' : '' }}">
            <i class="fa fa-question"></i><p>Faqs</p>
        </a>
    </li>
@endcan

@canany(['users.index', 'users.create', 'users.show', 'users.edit', 'users.destroy'])
    <li class="nav-item">
        <a href="{{ route('users.index') }}"
        class="nav-link {{ Request::is('users*') ? 'active' : '' }}">
            <i class="fa fa-user"></i><p>Users</p>
        </a>
    </li>
@endcan

@canany(['user_details.index', 'user_details.create', 'user_details.show', 'user_details.edit', 'user_details.destroy'])
    <li class="nav-item">
        <a href="{{ route('user_details.index') }}"
        class="nav-link {{ Request::is('user_details*') ? 'active' : '' }}">
            <i class="fa fa-user-cog"></i><p>User Details</p>
        </a>
    </li>
@endcan

@canany(['user_subscriptions.index', 'user_subscriptions.create', 'user_subscriptions.show', 'user_subscriptions.edit', 'user_subscriptions.destroy'])
    <li class="nav-item">
        <a href="{{ route('user_subscriptions.index') }}"
        class="nav-link {{ Request::is('user_subscriptions*') ? 'active' : '' }}">
            <i class="fa fa-user-plus"></i><p>User Subscriptions</p>
        </a>
    </li>
@endcan

@canany(['user_events.index', 'user_events.create', 'user_events.show', 'user_events.edit', 'user_events.destroy'])
    <li class="nav-item">
        <a href="{{ route('user_events.index') }}"
        class="nav-link {{ Request::is('user_events*') ? 'active' : '' }}">
            <i class="fa fa-calendar-alt"></i><p>User Events</p>
        </a>
    </li>
@endcan

@canany(['events.index', 'events.create', 'events.show', 'events.edit', 'events.destroy'])
    <li class="nav-item">
        <a href="{{ route('events.index') }}"
        class="nav-link {{ Request::is('events*') ? 'active' : '' }}">
            <i class="fa fa-calendar-check"></i><p>Events</p>
        </a>
    </li>
@endcan

@canany(['slots.index', 'slots.create', 'slots.show', 'slots.edit', 'slots.destroy'])
    <li class="nav-item">
        <a href="{{ route('slots.index') }}"
        class="nav-link {{ Request::is('slots*') ? 'active' : '' }}">
            <i class="fa fa-clock"></i><p>Slots</p>
        </a>
    </li>
@endcan

@canany(['appointments.index', 'appointments.create', 'appointments.show', 'appointments.edit', 'appointments.destroy'])
    <li class="nav-item">
        <a href="{{ route('appointments.index') }}"
        class="nav-link {{ Request::is('appointments*') ? 'active' : '' }}">
            <i class="fa fa-bookmark"></i><p>Appointments</p>
        </a>
    </li>
@endcan

@canany(['wellness_tips.index', 'wellness_tips.create', 'wellness_tips.show', 'wellness_tips.edit', 'wellness_tips.destroy'])
    <li class="nav-item">
        <a href="{{ route('wellness_tips.index') }}"
        class="nav-link {{ Request::is('wellness_tips*') ? 'active' : '' }}">
            <i class="fa fa-file-signature"></i><p>Wellness Tips</p>
        </a>
    </li>
@endcan

@canany(['favourites.index', 'favourites.create', 'favourites.show', 'favourites.edit', 'favourites.destroy'])
    <li class="nav-item">
        <a href="{{ route('favourites.index') }}"
        class="nav-link {{ Request::is('favourites*') ? 'active' : '' }}">
            <i class="fa fa-heart"></i><p>Favourites</p>
        </a>
    </li>
@endcan

@canany(['contact_requests.index', 'contact_requests.create', 'contact_requests.show', 'contact_requests.edit', 'contact_requests.destroy'])
    <li class="nav-item">
        <a href="{{ route('contact_requests.index') }}"
        class="nav-link {{ Request::is('cappointmentsontact_requests*') ? 'active' : '' }}">
            <i class="fa fa-contact-book"></i><p>Contact Requests</p>
        </a>
    </li>
@endcan

@canany(['meal_categories.index', 'meal_categories.create', 'meal_categories.show', 'meal_categories.edit', 'meal_categories.destroy'])
    <li class="nav-item">
        <a href="{{ route('meal_categories.index') }}"
        class="nav-link {{ Request::is('meal_categories*') ? 'active' : '' }}">
            <i class="fa fa-box-open"></i><p>Meal Categories</p>
        </a>
    </li>
@endcan

@canany(['meal_types.index', 'meal_types.create', 'meal_types.show', 'meal_types.edit', 'meal_types.destroy'])
    <li class="nav-item">
        <a href="{{ route('meal_types.index') }}"
        class="nav-link {{ Request::is('meal_types*') ? 'active' : '' }}">
            <i class="fa fa-boxes-stacked"></i><p>Meal Types</p>
        </a>
    </li>
@endcan

@canany(['meals.index', 'meals.create', 'meals.show', 'meals.edit', 'meals.destroy'])
    <li class="nav-item">
        <a href="{{ route('meals.index') }}"
        class="nav-link {{ Request::is('meals*') ? 'active' : '' }}">
            <i class="fa fa-bread-slice"></i><p>Meals</p>
        </a>
    </li>
@endcan

@canany(['meal_breakdowns.index', 'meal_breakdowns.create', 'meal_breakdowns.show', 'meal_breakdowns.edit', 'meal_breakdowns.destroy'])
    <li class="nav-item">
        <a href="{{ route('meal_breakdowns.index') }}"
        class="nav-link {{ Request::is('meal_breakdowns*') ? 'active' : '' }}">
            <i class="fa fa-table"></i><p>Meal Breakdowns</p>
        </a>
    </li>
@endcan

@canany(['recipes.index', 'recipes.create', 'recipes.show', 'recipes.edit', 'recipes.destroy'])
    <li class="nav-item">
        <a href="{{ route('recipes.index') }}"
        class="nav-link {{ Request::is('recipes*') ? 'active' : '' }}">
            <i class="fa fa-rectangle-list"></i><p>Recipes</p>
        </a>
    </li>
@endcan

@canany(['recipe_ingredients.index', 'recipe_ingredients.create', 'recipe_ingredients.show', 'recipe_ingredients.edit', 'recipe_ingredients.destroy'])
    <li class="nav-item">
        <a href="{{ route('recipe_ingredients.index') }}"
        class="nav-link {{ Request::is('recipe_ingredients*') ? 'active' : '' }}">
            <i class="fa fa-apple-alt"></i><p>Recipe Ingredients</p>
        </a>
    </li>
@endcan

@canany(['body_parts.index', 'body_parts.create', 'body_parts.show', 'body_parts.edit', 'body_parts.destroy'])
    <li class="nav-item">
        <a href="{{ route('body_parts.index') }}"
        class="nav-link {{ Request::is('body_parts*') ? 'active' : '' }}">
            <i class="fa fa-person-walking"></i><p>Body Parts</p>
        </a>
    </li>
@endcan

@canany(['exercises.index', 'exercises.create', 'exercises.show', 'exercises.edit', 'exercises.destroy'])
    <li class="nav-item">
        <a href="{{ route('exercises.index') }}"
        class="nav-link {{ Request::is('exercises*') ? 'active' : '' }}">
            <i class="fa fa-person-running"></i><p>Exercises</p>
        </a>
    </li>
@endcan

@canany(['exercise_equipments.index', 'exercise_equipments.create', 'exercise_equipments.show', 'exercise_equipments.edit', 'exercise_equipments.destroy'])
    <li class="nav-item">
        <a href="{{ route('exercise_equipments.index') }}"
        class="nav-link {{ Request::is('exercise_equipments*') ? 'active' : '' }}">
            <i class="fa fa-dumbbell"></i><p>Exercise Equipments</p>
        </a>
    </li>
@endcan

@canany(['exercise_equipment_pivots.index', 'exercise_equipment_pivots.create', 'exercise_equipment_pivots.show', 'exercise_equipment_pivots.edit', 'exercise_equipment_pivots.destroy'])
    <li class="nav-item">
        <a href="{{ route('exercise_equipment_pivots.index') }}"
        class="nav-link {{ Request::is('exercise_equipment_pivots*') ? 'active' : '' }}">
            <i class="fa fa-table-list"></i><p>Exercise Equipment Pivots</p>
        </a>
    </li>
@endcan

@canany(['packages.index', 'packages.create', 'packages.show', 'packages.edit', 'packages.destroy'])
    <li class="nav-item">
        <a href="{{ route('packages.index') }}"
        class="nav-link {{ Request::is('packages*') ? 'active' : '' }}">
            <i class="fa fa-box"></i><p>Packages</p>
        </a>
    </li>
@endcan

@canany(['transactions.index', 'transactions.create', 'transactions.show', 'transactions.edit', 'transactions.destroy'])
    <li class="nav-item">
        <a href="{{ route('transactions.index') }}"
        class="nav-link {{ Request::is('transactions*') ? 'active' : '' }}">
            <i class="fa fa-dollar"></i><p>Transactions</p>
        </a>
    </li>
@endcan

@canany(['workout_plans.index', 'workout_plans.create', 'workout_plans.show', 'workout_plans.edit', 'workout_plans.destroy'])
    <li class="nav-item">
        <a href="{{ route('workout_plans.index') }}"
        class="nav-link {{ Request::is('workout_plans*') ? 'active' : '' }}">
            <i class="fa fa-location"></i><p>Workout Plans</p>
        </a>
    </li>
@endcan

@canany(['workout_days.index', 'workout_days.create', 'workout_days.show', 'workout_days.edit', 'workout_days.destroy'])
    <li class="nav-item">
        <a href="{{ route('workout_days.index') }}"
        class="nav-link {{ Request::is('workout_days*') ? 'active' : '' }}">
            <i class="fa fa-location"></i><p>Workout Days</p>
        </a>
    </li>
@endcan

@canany(['workout_day_exercises.index', 'workout_day_exercises.create', 'workout_day_exercises.show', 'workout_day_exercises.edit', 'workout_day_exercises.destroy'])
    <li class="nav-item">
        <a href="{{ route('workout_day_exercises.index') }}"
        class="nav-link {{ Request::is('workout_day_exercises*') ? 'active' : '' }}">
            <i class="fa fa-location-arrow"></i><p>Workout Day Exercises</p>
        </a>
    </li>
@endcan

@canany(['nutrition_plans.index', 'nutrition_plans.create', 'nutrition_plans.show', 'nutrition_plans.edit', 'nutrition_plans.destroy'])
    <li class="nav-item">
        <a href="{{ route('nutrition_plans.index') }}"
        class="nav-link {{ Request::is('nutrition_plans*') ? 'active' : '' }}">
            <i class="fa fa-location"></i><p>Nutrition Plans</p>
        </a>
    </li>
@endcan

@canany(['nutrition_plan_days.index', 'nutrition_plan_days.create', 'nutrition_plan_days.show', 'nutrition_plan_days.edit', 'nutrition_plan_days.destroy'])
    <li class="nav-item">
        <a href="{{ route('nutrition_plan_days.index') }}"
        class="nav-link {{ Request::is('nutrition_plan_days*') ? 'active' : '' }}">
            <i class="fa fa-location"></i><p>Nutrition Plan Days</p>
        </a>
    </li>
@endcan

@canany(['nutrition_plan_day_recipes.index', 'nutrition_plan_day_recipes.create', 'nutrition_plan_day_recipes.show', 'nutrition_plan_day_recipes.edit', 'nutrition_plan_day_recipes.destroy'])
    <li class="nav-item">
        <a href="{{ route('nutrition_plan_day_recipes.index') }}"
        class="nav-link {{ Request::is('nutrition_plan_day_recipes*') ? 'active' : '' }}">
            <i class="fa fa-location-arrow"></i><p>Nutrition Plan Day Recipes</p>
        </a>
    </li>
@endcan

@canany(['nplan_day_recipe_ingredients.index', 'nplan_day_recipe_ingredients.create', 'nplan_day_recipe_ingredients.show', 'nplan_day_recipe_ingredients.edit', 'nplan_day_recipe_ingredients.destroy'])
    <li class="nav-item">
        <a href="{{ route('nplan_day_recipe_ingredients.index') }}"
        class="nav-link {{ Request::is('nplan_day_recipe_ingredients*') ? 'active' : '' }}">
            <i class="fa fa-location-arrow"></i><p>Nplan Day Recipe Ingredients</p>
        </a>
    </li>
@endcan

@canany(['nutrition_plan_day_meals.index', 'nutrition_plan_day_meals.create', 'nutrition_plan_day_meals.show', 'nutrition_plan_day_meals.edit', 'nutrition_plan_day_meals.destroy'])
    <li class="nav-item">
        <a href="{{ route('nutrition_plan_day_meals.index') }}"
        class="nav-link {{ Request::is('nutrition_plan_day_meals*') ? 'active' : '' }}">
            <i class="fa fa-location-arrow"></i><p>Nutrition Plan Day Meals</p>
        </a>
    </li>
@endcan

@canany(['questions.index', 'questions.create', 'questions.show', 'questions.edit', 'questions.destroy'])
    <li class="nav-item">
        <a href="{{ route('questions.index') }}"
        class="nav-link {{ Request::is('questions*') ? 'active' : '' }}">
            <i class="fa fa-question"></i><p>Questions</p>
        </a>
    </li>
@endcan

@canany(['options.index', 'options.create', 'options.show', 'options.edit', 'options.destroy'])
    <li class="nav-item">
        <a href="{{ route('options.index') }}"
        class="nav-link {{ Request::is('options*') ? 'active' : '' }}">
            <i class="fa fa-list-check"></i><p>Options</p>
        </a>
    </li>
@endcan

@canany(['question_answer_attempts.index', 'question_answer_attempts.create', 'question_answer_attempts.show', 'question_answer_attempts.edit', 'question_answer_attempts.destroy'])
    <li class="nav-item">
        <a href="{{ route('question_answer_attempts.index') }}"
        class="nav-link {{ Request::is('question_answer_attempts*') ? 'active' : '' }}">
            <i class="fa fa-play"></i><p>Question Answer Attempts</p>
        </a>
    </li>
@endcan
@canany(['promo_codes.index', 'promo_codes.create', 'promo_codes.show', 'promo_codes.edit', 'promo_codes.destroy'])
    <li class="nav-item">
        <a href="{{ route('promo_codes.index') }}"
        class="nav-link {{ Request::is('promo_codes*') ? 'active' : '' }}">
            <i class="fa fa-lock"></i><p>Promo Codes</p>
        </a>
    </li>
@endcan


@canany(['used_promo_codes.index', 'used_promo_codes.create', 'used_promo_codes.show', 'used_promo_codes.edit', 'used_promo_codes.destroy'])
    <li class="nav-item">
        <a href="{{ route('used_promo_codes.index') }}"
        class="nav-link {{ Request::is('used_promo_codes*') ? 'active' : '' }}">
            <i class="fa fa-unlock"></i><p>Used Promo Codes</p>
        </a>
    </li>
@endcan


