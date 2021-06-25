<?php

namespace App\Http\Requests;

use App\Models\Package;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
        $max = optional(Package::find($this->package_id), function ($package) {
            return optional($package->max, fn ($max) => 'max:' . $max);
        });

        return [
            'name' => ['required', 'string', 'max:255'],
            'title' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'company' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:13'],
            'category_id' => ['required', 'integer'],
            'package_id' => ['sometimes', 'required', 'integer'],
            'event_id' => ['required_without:package_id', 'integer'],
            'events' => ['required_with:package_id', 'array', 'min:1', $max]
        ];
    }
}
