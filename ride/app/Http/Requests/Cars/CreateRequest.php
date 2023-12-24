<?php

namespace App\Http\Requests\Cars;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\File;

class CreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [

            'model' => ['required', 'string'],
            'lga_id' => ['required', 'integer', 'exists:lgas,id'],
            'state_id' => ['required', 'integer', 'exists:states,id'],
            'brand' => ['required', 'string'],
            'mileage' => ['required', 'numeric', 'min:0'],
            'registration_number' => ['required', 'string'],
            'description' => ['required', 'string'],
            'pickup_address_details' => ['required', 'string'],
            'image' => ['required', File::types(['jpeg', 'png', 'jpg']),],
            'price_per_hour' => ['required', 'numeric', 'min:0'],
        ];
    }
}