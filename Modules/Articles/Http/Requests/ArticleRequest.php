<?php

namespace Modules\Articles\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required',
            'body'  => 'required',
            'file'  => 'required'
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function messages()
    {
        return [
            'title.required'    => 'Judul tidak boleh kosong',
            'body.required'     => 'Isi tidak boleh kosong',
            'file.required'     => 'File tidak boleh kosong',
        ];
    }
}
