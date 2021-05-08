<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateMatchRequest extends FormRequest
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
            'title_ar'       => 'required|string|min:3|max:225',
            'title_en'       => 'required|string|min:3|max:225',
            'description_ar' => 'required|string|min:3|max:225',
            'description_en' => 'required|string|min:3|max:225',
            'week_id'        => 'required|exists:seasons_weeks,id',
            'image'          => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'video'          => ['string', 'regex:/https:\/\/(?:www.)?(?:(vimeo).com\/(.*)|(youtube).com\/watch\?v=(.*?)&)/']
        ];
    }
}
