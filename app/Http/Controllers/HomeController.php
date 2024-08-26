<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Exercise;
use App\Models\PromoCode;
use App\Models\Role;
use App\Repositories\AppointmentRepository;
use App\Repositories\EventRepository;
use App\Repositories\ExerciseRepository;
use App\Repositories\PromoCodeRepository;
use App\Repositories\RecipeRepository;
use App\Repositories\UsersRepository;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        private UsersRepository $userRepository,
        private AppointmentRepository $appointmentRepository,
        private EventRepository $eventRepository,
        private ExerciseRepository $exerciseRepository,
        private RecipeRepository $recipeRepository,
        private PromoCodeRepository $promoCodeRepository,
    )
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mentorCount = $this->userRepository->getUsers(['role_names' => Role::MENTOR])->count();
        $appUserCount = $this->userRepository->getUsers(['role_names' => [Role::API_USER]])->count();
        $upcommingAppointmentCount = $this->appointmentRepository->getUpcommingAppointments()->count();
        $upcommingEventCount = $this->eventRepository->getUpcommingEvents()->count();
        $exerciseCount = $this->exerciseRepository->count();
        $recipeCount = $this->recipeRepository->count();
        $activePromoCodeCount = $this->promoCodeRepository->where('status', PromoCode::STATUS_ACTIVE)->count();

        return view('home', compact('mentorCount', 'appUserCount', 'upcommingAppointmentCount', 'upcommingEventCount', 'exerciseCount', 'recipeCount', 'activePromoCodeCount'));
    }
}
