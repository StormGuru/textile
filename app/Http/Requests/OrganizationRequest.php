<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrganizationRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
        'name' => 'required|string|max:100|min: 2',
        'adress' => 'required|string|max:100|min: 5',
        'tel' => 'required|string|max:100|min: 9',
        'site' => 'nullable|string|max:100',
        'description' => 'required|min:20|max: 1500',
        'images' => 'nullable|array',
        'category_id' => 'required'
        ];
    }
}
