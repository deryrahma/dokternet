<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ArticleRequest extends Request
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
    public function rules()
    {
        return [
            'article_category_id'   => 'required',
            'title'                 => 'required',
            'description'           => 'required',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'article_category_id.required'  => 'Diharuskan untuk memilih salah satu kategori',
            'title.required'                => 'Kolom judul wajib diisi',
            'description.required'          => 'Kolom deskripsi wajib diisi',
        ];
    }
}
