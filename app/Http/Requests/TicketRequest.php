<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TicketRequest extends FormRequest
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
            'title' => ['required', 'string', 'max:255', 'unique:categories'],
            'text_description' => ['required', 'text'],
            'labels' => ['required', 'array'],
            'labels.*' => ['exist:labels,id'],
            'categories' => ['required', 'array'],
            'categories.*' => ['exist:categories,id'],
            'priority' => ['required', 'in:low,medium,high'],
            'attachments' => ['nullable', 'array'],
            'attachments.*' => ['file', 'mimes:jpg,jpeg,png,pdf,doc,docx', 'max:2048'],
        ];
    }
}
