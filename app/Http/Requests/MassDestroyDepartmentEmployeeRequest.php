<?php

namespace App\Http\Requests;

use App\Models\DepartmentEmployee;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyDepartmentEmployeeRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('department_employee_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:department_employees,id',
        ];
    }
}
