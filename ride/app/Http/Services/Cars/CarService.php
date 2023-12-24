<?php

namespace App\Http\Services\Cars;

use App\Http\Controllers\Controller;
use App\Http\Requests\Cars\CreateRequest;
use App\Http\Services\Core\CoreService;
use App\Http\Services\States\LgasAndStatesService;
use App\Models\Car;

use App\Providers\RouteServiceProvider;

class CarService extends Controller
{
    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    public function store(CreateRequest $carCreateRequest)
    {

        $path = 'uploads/cars';
        $validatedData = $carCreateRequest->validated();
        $databasePath = CoreService::upload($path, 'image', $carCreateRequest);

        $validatedData['image'] = $databasePath;
        Car::create($validatedData);

        return redirect($this->redirectTo);
    }


    public function create()
    {
        $states = (new LgasAndStatesService)->getStates();
        return view('cars.upload', compact('states'));
    }
}