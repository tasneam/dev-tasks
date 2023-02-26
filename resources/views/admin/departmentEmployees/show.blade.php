@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.departmentEmployee.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.department-employees.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.departmentEmployee.fields.id') }}
                        </th>
                        <td>
                            {{ $departmentEmployee->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.departmentEmployee.fields.name') }}
                        </th>
                        <td>
                            {{ $departmentEmployee->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.departmentEmployee.fields.email') }}
                        </th>
                        <td>
                            {{ $departmentEmployee->email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.departmentEmployee.fields.roles') }}
                        </th>
                        <td>
                            @foreach($departmentEmployee->roles as $key => $roles)
                                <span class="label label-info">{{ $roles->title }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.departmentEmployee.fields.password') }}
                        </th>
                        <td>
                            ********
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.department-employees.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#department_employees_tasks" role="tab" data-toggle="tab">
                {{ trans('cruds.task.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="department_employees_tasks">
            @includeIf('admin.departmentEmployees.relationships.departmentEmployeesTasks', ['tasks' => $departmentEmployee->departmentEmployeesTasks])
        </div>
    </div>
</div>

@endsection