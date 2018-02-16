<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
            'title'         => 'required',
            'description'   => 'required|string',
            'category_id'   => 'required|string',
            'started'       => 'required|date|',
            'ended'         => 'required|date|after:started_at',
            'price'         => 'required|regex:/^\d*(\.\d{1,2})?$/',
            'student_max'   => 'required|integer|min:0',
            'post_type'     => 'in:stage|formation',
            'status'        => 'in:published,unpublished',
            'picture'       => 'required|image|mimes:jpeg,png,jpg,gif|max:2048' 
        ];
    }
}
