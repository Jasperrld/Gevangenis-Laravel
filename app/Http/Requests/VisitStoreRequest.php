<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VisitStoreRequest extends FormRequest
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
        return [
            'visitor_id' => 'required|exists:visitors,id',
            'prisoner_id' => 'required|exists:prisoners,id',
            'bezoekdatum' => 'required|date',
            'tijd_in' => 'required|date_format:H:i',
            'tijd_uit' => 'required|date_format:H:i',
            'location_id' => 'nullable|integer',
        ];
    }
}
