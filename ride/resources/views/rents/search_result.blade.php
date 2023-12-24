@extends('layouts.app')

@section('content')
    <div class="container">
        <form action="{{ route('selected.items') }}" method="post">
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

                <div class="col-md-3">
                    <div class="card mt-3 border-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="pickup_date">Pickup Date</label>
                                    <input type="date" name="pickup_date" class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="pickup_date">Pickup time</label>
                                    <input type="time" name="pickup_time" class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="pickup_date">Drop Off Date</label>
                                    <input type="date" name="drop_off_date" class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="pickup_date">Drop Off Time</label>
                                    <input type="time" name="drop_off_time" class="form-control">
                                </div>
                            </div>

                            <div class="row mt-2">
                                <div class="col-md-12">
                                    <button class="btn btn-primary">Proceed</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-8">

                    @foreach ($data['cars'] as $carData)
                        <div class="card mt-4 select-item" data-id ="{{ $carData->id }}">
                            <div class="card-header text-center">
                                <input type="hidden" name="selected[]">
                                <h3>{{ $carData->brand }} </h3>
                            </div>
                            <div class="card-body card-details">
                                <div class="car-image-div">
                                    <img src="{{ asset($carData->image) }}" alt="{{ $carData->brand }}">
                                </div>
                                <div class="vertical"></div>

                                <div class="other-details">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label for="model" class="lable"> <span class="d-block mt-2">Model: </span>
                                                <input type="text" value="{{ $carData->model }}"
                                                    class="form-control border-0"></label>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <label for="model" class="lable"> <span class="d-block mt-2">Price/Hour:
                                                </span>
                                                <input type="text" value="&#x20A6;{{ $carData->price_per_hour }}"
                                                    class="form-control border-0">
                                            </label>
                                        </div>
                                    </div>

                                    <div class="row">

                                        <div class="col-md-12">

                                            <label for="model" class="lable"> <span class="d-block mt-2">Location:
                                                </span>
                                                <input type="text"
                                                    value="{{ $data['state']->name }} | {{ $data['lga']->name }}"
                                                    class="form-control border-0">
                                            </label>

                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <label for="model" class="lable"> <span class="d-block mt-2">Mileage:
                                                </span>
                                                <textarea class="form-control border-0">{{ $carData->mileage }}</textarea>
                                            </label>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </form>
    </div>
@endsection
