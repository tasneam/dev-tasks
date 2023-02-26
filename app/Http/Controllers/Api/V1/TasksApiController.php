<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Http\Resources\Admin\TaskResource;
use App\Models\Task;
use Gate;
use Auth;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TasksApiController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth:api');
    }
    public function index()
    {
        $time=auth('departmentEmployees')->department_employees;
        return response()->json(['status' => true, 'message' => 'Success', 'object' => $time]);

        // abort_if(Gate::denies('task_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // return new TaskResource(Task::with(['department', 'project', 'department_employees', 'created_by'])->get());
    }

    public function store(StoreTaskRequest $request)
    {
        $user = Auth::guard('api')->user() ;
        $request['user_id']= $user->id;
        $task = Task::create($request->all());
        return response()->json([
            'status' => true,
            'message' => 'Success',
            'data' => [
                'task' => $task,
            ]
        ], Response::HTTP_OK);


        // return (new TaskResource($task))
        //     ->response()
        //     ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Task $task)
    {
        return Task::findOrFail($task);;

        // abort_if(Gate::denies('task_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        // return new TaskResource($task->load(['department', 'project', 'department_employees', 'created_by']));
    }

    public function update(UpdateTaskRequest $request, Task $task)
    {
        $task = Task::findOrFail($task);
        $user = Auth::guard('api')->user() ;
        if($request['user_id']= $user->id ){
        $task->update($request->all());
        }elseif($request['department_employees_id'] = Auth::guard('departmentEmployees')->departmentEmployees()){
        $task->update($request->status);
        }
        return response()->json([
            'status' => true,
            'message' => 'Success',
            'data' => [
                'task' => $task,
            ]
        ], Response::HTTP_OK);


        // return (new TaskResource($task))
        //     ->response()
        //     ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Task $task)
    {
        // abort_if(Gate::denies('task_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $task->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
