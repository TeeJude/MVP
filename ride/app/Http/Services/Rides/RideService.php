<?php

namespace App\Http\Services\Rides;

use App\Http\Controllers\Controller;
use App\Http\Requests\Cars\CreateRequest;
use App\Http\Requests\Rides\CheckoutRequest;
use App\Http\Requests\Rides\RideSelectionDetailRequest;
use App\Http\Services\Core\CoreService;
use App\Http\Services\States\LgasAndStatesService;
use App\Models\Car;
use App\Models\Lga;
use App\Models\RentDetails;
use App\Models\Rentee;
use App\Models\State;
use App\Providers\RouteServiceProvider;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class RideService extends Controller
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


    public function rent()
    {
        $states = (new LgasAndStatesService)->getStates();
        $allowedAge = [];

        return view('rents.rent', compact('states'));
    }

    public function search(Request $request)
    {

        $cars = Car::query()->where(['state_id' => $request->state_id, 'lga_id' => $request->lga_id])->get();
        $corespondingLga = Lga::find($request->lga_id);
        $corespondingState = State::find($request->state_id);


        $data =  [
            "cars" => $cars,
            "state" => $corespondingState,
            "lga" => $corespondingLga,
        ];
        Session::put('data', $data);

        return redirect('/ride/search/result');
    }


    public function result(Request $request)
    {
        $data = Session::get('data');
        return view('rents.search_result', compact('data'));
    }


    public function viewDetailsOfTheSelecedItems(RideSelectionDetailRequest $request)
    {
        $pickup_date = new DateTime($request->pickup_date);
        $pickup_time = explode(':', $request->pickup_time);

        $drop_off_time = explode(':', $request->drop_off_time);

        $drop_off_date =  new DateTime($request->drop_off_date);

        $selected = $request->selected;
        $resultArray = array_filter($selected, function ($value) {
            return $value !== null;
        });

        // Re-index the array if needed
        $resultArray = array_values($resultArray);

        $pickupDateTime = $pickup_date->setTime($pickup_time[0], $pickup_time[1]);

        $dropOffDateTime = $drop_off_date->setTime($drop_off_time[0], $drop_off_time[1]);
        $interval = $dropOffDateTime->diff($pickupDateTime);
        $totalHoursDifference = $interval->h + ($interval->days * 24);
        $totalCost = 0;

        $cars = [];

        if (count($resultArray) < 1) {
            return back()->withErrors(['error' => "Please select a car from the searched result"]);
        }

        for ($i = 0; $i < count($resultArray); $i++) {

            $car = Car::find($resultArray[$i]);

            $price = (int) $car->price_per_hour * (int) $totalHoursDifference;
            $totalCost += $price;

            array_push($cars, $car->id);
        }


        $data = [
            'cost' => $totalCost,
            'cars' => $cars,
            'pickup_date' => $pickupDateTime->format('Y-m-d H:1'),
            'dropoff_date' => $dropOffDateTime->format('Y-m-d H:i'),
            'pickup_time' => $request->pickup_time,
            'drop_off_time' => $request->drop_off_time,
        ];

        Session::put('checkout_data', $data);

        return redirect('ride/selected/checkout');
    }

    public function selectedCheckoutPage()
    {
        $data = Session::get('checkout_data');
        // Session::forget('checkout_data');
        return view('rents.checkout', compact('data'));
    }

    public function checkout(CheckoutRequest $request)
    {
        $validatedData = $request->validated();

        if ($request->hasFile('driver_liscence_image')) {
            $path = 'uploads/id_cards';
            $databasePath = CoreService::upload($path, 'driver_liscence_image', $request);
            $validatedData['driver_liscence_image'] = $databasePath;
        }

        if ($request->hasFile('id_card_image')) {
            $path = 'uploads/id_cards';
            $databasePath = CoreService::upload($path, 'id_card_image', $request);
            $validatedData['id_card_image'] = $databasePath;
        }

        $rentee = Rentee::create($validatedData);

        $data = Session::get('checkout_data');
        $resultArray = array_filter($data['cars'], function ($value) {
            return $value !== null;
        });

        // Re-index the array if needed
        $resultArray = array_values($resultArray);

        $pickup_date = $data['pickup_date'];
        $drop_off_date = $data['dropoff_date'];
        $carsId = $data['cars'];
        RentDetails::create([
            'pickup_date' => $pickup_date,
            'drop_off_date' => $drop_off_date,
            'rentee_id' => $rentee->id,
            'car_ids' => json_encode($carsId),
        ]);

        return redirect('/')->with('message', 'Ride booked successfully');
    }
}