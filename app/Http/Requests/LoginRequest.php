<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class LoginRequest extends FormRequest
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
            'email'     => 'required|string|email',
            'password'  => 'required|string',
        ];

        return $rules;
    }

    public function messages(): array
    {
        $messages =  [
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
