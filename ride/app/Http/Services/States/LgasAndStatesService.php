<?php

namespace App\Http\Services\States;

use App\Http\Controllers\Controller;
use App\Models\Lga;
use App\Models\State;

class LgasAndStatesService extends Controller
{
    public function getStates()
    {
        return State::all();
    }


    public function getLgas($state_id)
    {
        $lgas = Lga::where(['state_id' => $state_id])->get();
        return json_encode(['data' => $lgas, 'status' => true]);
    }
}