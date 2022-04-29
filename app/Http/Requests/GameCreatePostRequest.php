<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GameCreatePostRequest extends FormRequest
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
            'name' => 'required|unique:games|max:255',
            'studio' => 'required|max:255',
            'genre.0' => 'required',
            'genre.*' => 'max:255|distinct'
        ];
    }
}
