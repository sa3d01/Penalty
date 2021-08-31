<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class CoachStoreRequest extends FormRequest
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
            'sport_id' => 'required|numeric|exists:sports,id',
            'city' => 'required',
            'nationality' => 'required',
            'nationality_id' => 'required',
            'academy_id' => 'required|numeric|exists:academies,id',
        ];
    }

}
