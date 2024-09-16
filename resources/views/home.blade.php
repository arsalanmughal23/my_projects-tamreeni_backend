@extends('layouts.app')

@section('content')
<div class="container-fluid py-3">
    <div class="row">
        <div class="col-lg-3 col-6">

            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $mentorCount }}</h3>
                    <p>Mentors</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person"></i>
                </div>
                <a href="{{ route('users.index') }}?userRole=Mentor" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-3 col-6">

            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $appUserCount }}</h3>
                    <p>Application Users</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-stalker"></i>
                </div>
                <a href="{{ route('users.index') }}?userRole=User" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-3 col-6">

            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ $upcommingAppointmentCount }}</h3>
                    <p>Upcomming Appointments</p>
                </div>
                <div class="icon">
                    <i class="ion ion-android-alarm-clock"></i>
                </div>
                <a href="{{ route('appointments.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-3 col-6">

            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{ $upcommingEventCount }}</h3>
                    <p>Upcomming Events</p>
                </div>
                <div class="icon">
                    <i class="ion ion-share"></i>
                </div>
                <a href="{{ route('events.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-3 col-6">

            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{ $exerciseCount }}</h3>
                    <p>Exercise</p>
                </div>
                <div class="icon">
                    <i class="fa fa-running"></i>
                </div>
                <a href="{{ route('exercises.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-6">

            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ $recipeCount }}</h3>
                    <p>Recipe</p>
                </div>
                <div class="icon">
                    <i class="fa fa-burger"></i>
                </div>
                <a href="{{ route('recipes.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-6">

            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $activePromoCodeCount }}</h3>
                    <p>Active Promo Codes</p>
                </div>
                <div class="icon">
                    <i class="fa fa-money-bill-alt"></i>
                </div>
                <a href="{{ route('promo_codes.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

    </div>
</div>
@endsection
