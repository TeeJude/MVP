@extends('layouts.app')

@section('content')
<div class="container">
    <form action="{{ route('ride.checkout') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row justify-content-center">

            @if ($errors->any())
            <div>
                <ul>
                    @foreach ($errors->all() as $error)
                    <li class="alert alert-danger">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            @if($data)
            <div class="col-md-5" style="position: sticky; top: 10px;">
                <div class="card border-0">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">

                                <span> Pickup Date: {{$data['pickup_date']}}</span> | <span>Time:
                                    {{$data['pickup_time']}}</span>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <span> Dropoff Date: {{$data['dropoff_date']}}</span> | <span>Time:
                                    {{$data['drop_off_time']}}</span>
                            </div>
                        </div>
                        <hr>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-12">
                                    <span>Total Cost: &#x20A6;{{$data['cost']}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-7">
                <div class="card border-0">
                    <div class="card-body">

                        <div class="row">
                            <div class="col-md-12">
                                <label for="firstname">First Name</label>
                                <input type="text" required name="firstname" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label for="surname">Surname</label>
                                <input type="text" required name="surname" class="form-control">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <label for="email">Email <Address></Address></label>
                                <input type="email" name="email" class="form-control">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <label for="phone_number">Phone Number</label>
                                <input type="text" name="phone_number" class="form-control">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <label for="driver_liscence_number">Liscence Number</label>
                                <input type="text" name="driver_liscence_number" class="form-control">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <label for="driver_liscence_image">Liscence Image:</label>
                                <input type="file" name="driver_liscence_image" class="form-control">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <label for="id_card_nuber">ID Card Number</label>
                                <input type="text" name="id_card_nuber" class="form-control">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <label for="id_card_image">ID Card Image</label>
                                <input type="file" name="id_card_image" class="form-control">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <label for="city">City</label>
                                <input type="text" name="city" class="form-control">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <label for="address">Address</label>
                                <textarea name="addresss" class="form-control"></textarea>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 mt-4">
                                <button class="btn btn-primary">Book Ride</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @else
            <p>Please go back and reselect new data</p>
            @endif
        </div>
    </form>
</div>
@endsection