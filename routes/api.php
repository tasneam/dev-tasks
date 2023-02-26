<?php
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'v1' , 'namespace' => 'Api\V1' 
,'middleware' => ['auth:api , departmentEmployees']], function ()
{
    Route::post('tasks', 'TasksApiController@store');

});


// Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:sanctum']], function () {
//     // Permissions
//     Route::apiResource('permissions', 'PermissionsApiController');

//     // Roles
//     Route::apiResource('roles', 'RolesApiController');

//     // Users
//     Route::apiResource('users', 'UsersApiController');

//     // Departments
//     Route::apiResource('departments', 'DepartmentsApiController');

//     // Projects
//     Route::apiResource('projects', 'ProjectsApiController');

//     // Tasks
//     Route::apiResource('tasks', 'TasksApiController');

//     // Department Employees
//     Route::apiResource('department-employees', 'DepartmentEmployeesApiController');
// });
