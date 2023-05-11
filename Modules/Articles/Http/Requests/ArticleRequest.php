<?php

namespace Modules\Articles\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
            'title' => 'required',
            'body'  => 'required',
            'file' => 'required',
        ];

        return $rules;
    }

    public function messages(): array
    {
        $messages =  [
            'title.required'    => 'Judul Artikel tidak boleh kosong',
            'body.required'     => 'Isi Artikel tidak boleh kosong',
            'file.required'     => 'Upload File tidak boleh kosong',
        ];

        return $messages;
    }

    public function attributes(): array
    {
        $attributes = [
            'title' => 'Judul Artikel',
            'body' => 'Body Artikel',
            'file' => 'Upload File',
        ];

        return $attributes;
    }

}
