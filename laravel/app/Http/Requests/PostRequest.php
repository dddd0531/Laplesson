<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class PostRequest extends Request
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
		'lessonimage'  => 'required|image|mimes:png|max:2000',//kbyte
        'title' => 'required|min:3',
        'body' => 'required',
        'movie' => 'required',
        'category_id' => 'required'
        ];
    }
}
