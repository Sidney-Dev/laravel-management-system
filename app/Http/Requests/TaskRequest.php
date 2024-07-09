<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
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
            'name' => 'required|string|max:100',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'status' => 'required|in:pending,in progress,in review,done,needs assistance',
            'owner_id' => 'nullable|exists:users,id',
            'project_id' => 'required|exists:projects,id',
            'reporter_id' => 'required|exists:users,id',
        ];
    }

    /**
     * @todo review
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'reporter_id' => $this->reporter_id ?? Auth::id(),
            'owner_id' => $this->owner_id ?? null,
        ]);
    }
}
