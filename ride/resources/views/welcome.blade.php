@extends('layouts.app')

@section('content')
    <div class="container-fluid ">
        <section class="home">
            @if (session()->has('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif

            <h1>
                Welcome to rideon
            </h1>
            <p>
                Need to rent a ride to move around town, we've got you covered. Book a ride today and experience the
                comfort that comes with our fleet.
            </p>
        </section>
    </div>
@endsection
