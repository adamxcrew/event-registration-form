<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PackageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->hasRole(['superadmin', 'admin']);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', Rule::unique('packages', 'name')->ignore(optional($this->package)->id)],
            'description' => ['nullable', 'string'],
            'prices' => ['sometimes', 'required', 'array', 'min:1'],
        ];
    }
}
