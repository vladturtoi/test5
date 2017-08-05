<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProduct extends FormRequest
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
		    'name' => 'required|max:150',
		    'type' => 'required',
		    'description' => 'max:60535',
		    'price' => 'required|numeric|between:1,2000',
		    'discount' => 'nullable|numeric|between:1,2000|max:' . request('price'),
	    ];
    }
}
