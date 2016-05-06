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
            'id' => 'numeric',
            'title' => 'required|unique:permissions,slug,'.$this->id,
            'editor-markdown-doc' => 'required',
            'intro_number' => 'required|numeric',
            'status' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'required'  => trans('validation.required'),
            'unique'    => trans('validation.unique'),
            'numeric'   => trans('validation.numeric'),
        ];
    }

    public function attributes()
    {
        return [
            'id'            => trans('labels.id'),
            'title'          => trans('labels.article.title'),
            'editor-markdown-doc' => trans('labels.article.content'),
            'intro_number'   => trans('labels.article.intro_number'),
            'status'        => trans('labels.article.status'),     
        ];
    }
}
