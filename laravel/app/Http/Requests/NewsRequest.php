<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class NewsRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //return false;
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
        'newsimg1'  => 'image|mimes:jpg,jpeg,gif,png|max:2000',//kbyte
        'title' => 'required|min:3',
        'open' => 'required'
        ];
    }
}
