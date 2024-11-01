<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CellStoreRequest extends FormRequest
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
            'prisoner_id' => 'required|exists:prisoners,id', // Adjust 'prisoners' to your actual table name
            // Add other validation rules as needed
        ];
    }
}
