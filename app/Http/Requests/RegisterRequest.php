<?php

namespace App\Http\Requests;

use Illuminate\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $rules =  [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ];

        return $rules;
    }

    public function messages(): array
    {
        $messages =  [
            'name.required'    => 'Name tidak boleh kosong',
            'email.required'    => 'Email tidak boleh kosong',
            'password.required' => 'Password tidak boleh kosong',
        ];

        return $messages;
    }

    public function failed(Validator $validator): array
    {
        throw new HttpResponseException(response()->json([
            'message'   => 'Unauthorized',
            'error'      => $validator->errors()
        ]));
    }
}
