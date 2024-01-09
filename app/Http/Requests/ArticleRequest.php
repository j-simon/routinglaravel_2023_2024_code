<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        return true; //false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => [ 
				'required',
				function($attribute, $value, $fail) {
					if (strpos($value,'Laravel') === false) {
						$fail($attribute.' enthält nicht den Text Laravel');
					}
				}
			],
			'text' => 'required'
            //
        ];
    }

}
