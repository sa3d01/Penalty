<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class GroupStoreRequest extends FormRequest
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
            'price' => 'required|numeric',
            'academy_id' => 'required|numeric|exists:academies,id',
            'sport_id' => 'required|numeric|exists:sports,id',
            'days' => 'required',
            'start_time' => 'required',
            'duration' => 'required',
            'comment' => 'nullable',
            'coaches' => 'required',
            'players' => 'required',
            'from_date' => 'nullable',
            'to_date' => 'nullable',
        ];
    }

}
