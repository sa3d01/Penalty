<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class AcademyStoreRequest extends FormRequest
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
            'name' => 'required|string|max:25',
            'email' => 'required|email:rfc,dns|max:90|unique:users',
            'phone' => 'required|unique:users',
            'password' => 'required|string|min:6|max:15',
            'avatar' => 'nullable|image',
            'country_id' => 'required|numeric|exists:countries,id',
            'ad_id' => 'required|numeric|exists:ads,id',
            'academy_size_id' => 'required|numeric|exists:academy_sizes,id',
            'city' => 'required',
            'district' => 'required',
            'lat' => 'nullable',
            'lng' => 'nullable',
            'sport_id' => 'nullable|numeric|exists:sports,id',
            'nationality' => 'nullable',
            'nationality_id' => 'nullable',
        ];
    }

}
