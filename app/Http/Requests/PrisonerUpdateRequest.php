<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PrisonerUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $prisoner = $this->route(param: 'prisoner');
        return [
            'name' => 'required|string|min:1|max:45|unique:prisoners,name,'.$prisoner->id
        ];
    }
}
