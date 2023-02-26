<?php

namespace App\Http\Requests;

use App\Models\DepartmentEmployee;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateDepartmentEmployeeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('department_employee_edit');
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
                'unique:department_employees,email,' . request()->route('department_employee')->id,
            ],
            'roles.*' => [
                'integer',
            ],
            'roles' => [
                'required',
                'array',
            ],
        ];
    }
}
