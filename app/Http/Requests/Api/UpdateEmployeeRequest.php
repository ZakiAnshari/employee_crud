<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateEmployeeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $id = $this->route('employee');

        return [
            'employee_id' => ['sometimes', 'required', 'string', 'max:50', Rule::unique('karyawans', 'employee_id')->ignore($id)],
            'name' => ['sometimes', 'required', 'string', 'max:150'],
            'gender' => ['sometimes', 'required', 'in:L,P'],
            'email' => ['sometimes', 'required', 'email', 'max:150', Rule::unique('karyawans', 'email')->ignore($id)],
            'phone' => ['sometimes', 'required', 'string', 'max:20'],
            'department' => ['sometimes', 'required', 'string', 'max:100'],
            'join_date' => ['sometimes', 'required', 'date'],
            'is_active' => ['sometimes', 'required', 'boolean'],
        ];
    }
}
