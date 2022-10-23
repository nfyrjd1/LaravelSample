<?php

namespace App\Http\Requests\Blog\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CategoryCreateRequest extends FormRequest
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
            'title' => 'required|min:5|max:255',
            'slug' => 'max:255|unique:blog_categories',
            'description' => 'required|max:500|min:3',
            'parent_id' => 'required|integer|exists:blog_categories,id',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Название обязательно для заполнения',
            'title.min' => 'Минимальная длина названия 5 символов',
            'title.max'  => 'Название не должно превышать 255 символов',
            'slug.max'  => 'Идентификатор не должен превышать 255 символов',
            'description.required'  => 'Описание обязательно для заполнения',
            'description.max'  => 'Описание не должно превышать 500 символов',
            'description.min'  => 'Минимальная длина описания 3 символа',
            'parent_id.required'  => 'Родитель обязателен для заполнения',
            'parent_id.exists'  => 'Не удалось найти родителя',
        ];
    }
}
