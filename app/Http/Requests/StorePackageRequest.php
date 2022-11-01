<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePackageRequest extends FormRequest
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
            'service.service_id' => ['required'],
            'contact.name' => ['required'],
            'contact.phone' => ['required'],
            'contact.email' => ['required', 'email'],
            'contact.address_line_1' => ['required'],
            'contact.city' => ['required'],
            'contact.zip' => ['required'],
            'contact.country' => ['required', 'min:2', 'max:2'],
        ];
    }
}
