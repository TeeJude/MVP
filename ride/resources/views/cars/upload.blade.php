@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">{{ __('Upload Rides Data') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('cars.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="row mb-3">
                            <label for="brand" class="col-md-4 col-form-label text-md-end">{{ __('Brand') }}</label>

                            <div class="col-md-6">
                                <input id="brand" type="text" class="form-control @error('brand') is-invalid @enderror"
                                    name="brand" value="{{ old('brand') }}" required>

                                @error('brand')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="model" class="col-md-4 col-form-label text-md-end">{{ __('Model') }}</label>

                            <div class="col-md-6">
                                <input id="model" type="model" class="form-control @error('model') is-invalid @enderror"
                                    name="model" value="{{ old('model') }}" required>

                                @error('model')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="state_id" class="col-md-4 col-form-label text-md-end">{{ __('state ') }}</label>

                            <div class="col-md-6">
                                <select id="state_id" class="form-control @error('state_id') is-invalid @enderror"
                                    name="state_id" required>
                                    <option value="">select State</option>
                                    @foreach ($states as $state)
                                    <option value="{{ $state->id }}">{{ $state->name }}</option>
                                    @endforeach
                                </select>

                                @error('state_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="lga_id" class="col-md-4 col-form-label text-md-end">{{ __('LGAs ') }}</label>

                            <div class="col-md-6">
                                <select id="lga_id" class="form-control @error('lga_id') is-invalid @enderror"
                                    name="lga_id" required>
                                    <option value="">select lga</option>
                                </select>

                                @error('lga_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="mileage" class="col-md-4 col-form-label text-md-end">{{ __('Mileage') }}</label>

                            <div class="col-md-6">
                                <input id="mileage" type="text"
                                    class="form-control @error('mileage') is-invalid @enderror" name="mileage"
                                    value="{{ old('mileage') }}" required autocomplete="mileage" autofocus>

                                @error('mileage')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="registration_number" class="col-md-4 col-form-label text-md-end">{{
                                __('Registration Number') }}</label>

                            <div class="col-md-6">
                                <input id="registration_number" type="text"
                                    class="form-control @error('registration_number') is-invalid @enderror"
                                    name="registration_number" value="{{ old('registration_number') }}" required
                                    autocomplete="registration_number" autofocus>

                                @error('registration_number')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="pickup_address_details" class="col-md-4 col-form-label text-md-end">{{
                                __('Pickup Location') }}</label>

                            <div class="col-md-6">
                                <textarea id="pickup_address_details"
                                    class="form-control @error('pickup_address_details') is-invalid @enderror"
                                    name="pickup_address_details" value="{{ old('pickup_address_details') }}" required
                                    autocomplete="pickup_address_details" autofocus></textarea>

                                @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="description" class="col-md-4 col-form-label text-md-end">{{ __('Description')
                                }}</label>

                            <div class="col-md-6">
                                <textarea id="description"
                                    class="form-control @error('description') is-invalid @enderror" name="description"
                                    value="{{ old('description') }}" required autocomplete="description"
                                    autofocus></textarea>

                                @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>


                        <div class="row mb-3">
                            <label for="price_per_hour" class="col-md-4 col-form-label text-md-end">{{ __('Price/Hour')
                                }}</label>

                            <div class="col-md-6">
                                <input id="price_per_hour" type="text"
                                    class="form-control @error('price_per_hour') is-invalid @enderror"
                                    name="price_per_hour" value="{{ old('price_per_hour') }}" required
                                    autocomplete="price_per_hour" autofocus>

                                @error('price_per_hour')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="image" class="col-md-4 col-form-label text-md-end">{{ __('Vehicle Picture')
                                }}</label>

                            <div class="col-md-6">
                                <input id="image" type="file" class="form-control @error('image') is-invalid @enderror"
                                    name="image">

                                @error('image')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>


                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Create') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection