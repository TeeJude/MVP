<?php

namespace App\Http\Requests\Rides;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

class RideSelectionDetailRequest extends FormRequest
{
    protected $stopOnFirstFailure = true;
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

            'pickup_date' => [
                'required',
                'date_format:Y-m-d'
            ],

            'pickup_time' => [
                'required',
                'date_format:H:i'
            ],

            'drop_off_date' => [
                'required',
                'date_format:Y-m-d',
                'after_or_equal:pickup_date'
            ],

            'drop_off_time' => [
                'required',
                'date_format:H:i'
            ],

            'selected' => ['required', 'array', 'min:1'],
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