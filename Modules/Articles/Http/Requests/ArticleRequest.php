<?php

namespace Modules\Articles\Http\Requests;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Validator;
use App\Http\FormRequest;

class ArticleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        $rules =  [
            'title' => 'required|string|max:100',
            'body'  => 'required|string',
            'file' => 'required'
        ];

        return $rules;
    }

    public function messages(): array
    {
        $messages =  [
            'title.required'    => 'Judul Artikel tidak boleh kosong',
            'body.required'     => 'Isi Artikel tidak boleh kosong',
            'file.required'     => 'Upload File tidak boleh kosong'
        ];

        return $messages;
    }

    public function failed(Validator $validator): array
    {
        throw new HttpResponseException(response()->json([
            'success'   => false,
            'message'   => 'Validation errors',
            'data'      => $validator->errors()
        ]));
    }
}
