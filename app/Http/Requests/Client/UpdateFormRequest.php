<?php

namespace App\Http\Requests\Client;

use Illuminate\Foundation\Http\FormRequest;
use Elegant\Sanitizer\Laravel\SanitizesInput;

class UpdateFormRequest extends FormRequest
{
    use SanitizesInput;

    public function filters()
    {
        return [
            'client_document' => 'digit'
        ];
    }

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
    public function rules(\Illuminate\Http\Request $request)
    {
        return [
            'client_name' => ['required', "unique:clients,client_name,{$request->client_id}", 'min:2', 'max:255'],
            'client_document' => ['required', "unique:clients,client_document,{$request->client_id}"],
            'foundation_date' => ['required'],
            'client_id' => ['nullable', 'exists:clients,id'],
            'group_id' => ['nullable', 'exists:groups,id'],
        ];
    }
}
