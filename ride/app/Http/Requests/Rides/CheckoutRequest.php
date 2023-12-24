<?php

namespace App\Http\Requests\Rides;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\File;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

class CheckoutRequest extends FormRequest
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

            'firstname' => ['required', 'string', 'max:25'],
            'surname' => ['required', 'string', 'max:25'],
            'phone_number' => ['required', 'string', 'max:25'],
            'email' => ['required', 'email', 'max:25'],

            'city' => ['required', 'string', 'max:25'],
            'addresss' => ['required', 'string', 'min:4'],

            'driver_liscence_image' => ['nullable', File::types(['jpeg', 'png', 'jpg']),],
            'driver_liscence_number' => ['nullable', 'string'],
            'id_card_image' => ['nullable',  File::types(['jpeg', 'png', 'jpg']),],
            'id_card_nuber' => ['nullable', 'string'],
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        // Your custom logic for handling validation failure

        // If the request is an AJAX request, return a JSON response with errors
        if ($this->expectsJson()) {
            throw new HttpResponseException(
                response()->json(['errors' => $validator->errors()], JsonResponse::HTTP_UNPROCESSABLE_ENTITY)
            );
        }

        // If the request is not AJAX, redirect back with errors
        throw new HttpResponseException(
            redirect()->back()->withErrors($validator)->withInput()
        );
    }
}