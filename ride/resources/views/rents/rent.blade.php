@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-center">{{ __('Search Ride') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('cars.search') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-3">
                                <label for="age"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Age ') }}</label>

                                <div class="col-md-6">
                                    <select id="age" class="form-control @error('age') is-invalid @enderror"
                                        name="age" required>
                                        <option value="">select age</option>
                                        @php
                                            $i = 18;
                                        @endphp
                                        @for ($i > 17; $i <= 64; $i++)
                                            <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                    </select>

                                    @error('age')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="state_id"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Pickup State ') }}</label>

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
                                <label for="lga_id"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Pickup Location ') }}</label>

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

                            <div class="row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Search') }}
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
