<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyDepartmentEmployeeRequest;
use App\Http\Requests\StoreDepartmentEmployeeRequest;
use App\Http\Requests\UpdateDepartmentEmployeeRequest;
use App\Models\DepartmentEmployee;
use App\Models\Role;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DepartmentEmployeesController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('department_employee_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $departmentEmployees = DepartmentEmployee::with(['roles', 'created_by'])->get();

        return view('admin.departmentEmployees.index', compact('departmentEmployees'));
    }

    public function create()
    {
        abort_if(Gate::denies('department_employee_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $roles = Role::pluck('title', 'id');

        return view('admin.departmentEmployees.create', compact('roles'));
    }

    public function store(StoreDepartmentEmployeeRequest $request)
    {
        $departmentEmployee = DepartmentEmployee::create($request->all());
        $departmentEmployee->roles()->sync($request->input('roles', []));

        return redirect()->route('admin.department-employees.index');
    }

    public function edit(DepartmentEmployee $departmentEmployee)
    {
        abort_if(Gate::denies('department_employee_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $roles = Role::pluck('title', 'id');

        $departmentEmployee->load('roles', 'created_by');

        return view('admin.departmentEmployees.edit', compact('departmentEmployee', 'roles'));
    }

    public function update(UpdateDepartmentEmployeeRequest $request, DepartmentEmployee $departmentEmployee)
    {
        $departmentEmployee->update($request->all());
        $departmentEmployee->roles()->sync($request->input('roles', []));

        return redirect()->route('admin.department-employees.index');
    }

    public function show(DepartmentEmployee $departmentEmployee)
    {
        abort_if(Gate::denies('department_employee_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $departmentEmployee->load('roles', 'created_by', 'departmentEmployeesTasks');

        return view('admin.departmentEmployees.show', compact('departmentEmployee'));
    }

    public function destroy(DepartmentEmployee $departmentEmployee)
    {
        abort_if(Gate::denies('department_employee_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $departmentEmployee->delete();

        return back();
    }

    public function massDestroy(MassDestroyDepartmentEmployeeRequest $request)
    {
        $departmentEmployees = DepartmentEmployee::find(request('ids'));

        foreach ($departmentEmployees as $departmentEmployee) {
            $departmentEmployee->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
