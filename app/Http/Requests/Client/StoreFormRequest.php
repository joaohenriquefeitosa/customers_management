<?php

namespace App\Http\Requests\Client;

use Illuminate\Foundation\Http\FormRequest;

class StoreFormRequest extends FormRequest
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
            'client_name' => ['required', 'unique:groups,group_name', 'min:2', 'max:255'],
            'client_document' => ['required'],
            'foundation_date' => ['required'],
            'group_id' => ['nullable', 'exists:groups,id'],
        ];
    }
}
