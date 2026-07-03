<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class StoreEmployeeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'employee_id' => 'required|string|max:50|unique:karyawans,employee_id',
            'name' => 'required|string|max:150',
            'gender' => 'required|in:L,P',
            'email' => 'required|email|max:150|unique:karyawans,email',
            'phone' => 'required|string|max:20',
            'department' => 'required|string|max:100',
            'join_date' => 'required|date',
            'is_active' => 'required|boolean',
        ];
    }
}
