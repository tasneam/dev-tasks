<?php

namespace App\Http\Requests;

use App\Models\DepartmentEmployee;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreDepartmentEmployeeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('department_employee_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'email' => [
                'required',
                'unique:department_employees',
            ],
            'roles.*' => [
                'integer',
            ],
            'roles' => [
                'required',
                'array',
            ],
            'password' => [
                'required',
            ],
        ];
    }
}
