<?php

namespace App\Http\Services\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Client\StoreRequest;
use App\Models\Client;
use App\Models\Core\Gender;
use App\Providers\RouteServiceProvider;

class ClientService extends Controller
{
    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    public function store(StoreRequest $client)
    {

        $validatedData = $client->validated();
        $validatedData['others'] = 'other information';
        Client::create($validatedData);

        return redirect($this->redirectTo);
    }


    public function create()
    {
        $genders = Gender::all();
        return view('clients.create', compact('genders'));
    }
}