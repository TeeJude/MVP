<?php

namespace App\Http\Requests\Client;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreRequest extends FormRequest
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

            'fullname' => ['required', 'string'],
            'address'  => ['required', 'string', 'min:12'],
            'phone'    => ['required', 'string', 'unique:clients,phone'],
            'email'    => ['required', 'email', 'unique:clients,email'],
            'gender'   => ['required', 'string', 'exists:genders,id'],
            'others'   => ['nullable', 'string'],
        ];
    }
}