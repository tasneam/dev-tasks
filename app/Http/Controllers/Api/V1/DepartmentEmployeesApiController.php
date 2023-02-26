<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDepartmentEmployeeRequest;
use App\Http\Requests\UpdateDepartmentEmployeeRequest;
use App\Http\Resources\Admin\DepartmentEmployeeResource;
use App\Models\DepartmentEmployee;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DepartmentEmployeesApiController extends Controller
{
    public function index()
    {
        // abort_if(Gate::denies('department_employee_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new DepartmentEmployeeResource(DepartmentEmployee::with(['roles', 'created_by'])->get());
    }

    public function store(StoreDepartmentEmployeeRequest $request)
    {
        $departmentEmployee = DepartmentEmployee::create($request->all());
        $departmentEmployee->roles()->sync($request->input('roles', []));

        return (new DepartmentEmployeeResource($departmentEmployee))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(DepartmentEmployee $departmentEmployee)
    {
        abort_if(Gate::denies('department_employee_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new DepartmentEmployeeResource($departmentEmployee->load(['roles', 'created_by']));
    }

    public function update(UpdateDepartmentEmployeeRequest $request, DepartmentEmployee $departmentEmployee)
    {
        $departmentEmployee->update($request->all());
        $departmentEmployee->roles()->sync($request->input('roles', []));

        return (new DepartmentEmployeeResource($departmentEmployee))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(DepartmentEmployee $departmentEmployee)
    {
        abort_if(Gate::denies('department_employee_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $departmentEmployee->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
