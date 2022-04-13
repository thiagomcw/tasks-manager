<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Task\StoreRequest;
use App\Http\Requests\Api\Task\UpdateRequest;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class TaskController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        $tasks = Task::query()->orderByDesc('created_at')->get();

        return TaskResource::collection($tasks);
    }

    public function store(StoreRequest $request): TaskResource
    {
        $task = Task::query()->create($request->validated());

        return new TaskResource($task);
    }

    public function update(Task $task, UpdateRequest $request): TaskResource
    {
        $task->update($request->validated());

        return new TaskResource($task);
    }

    public function destroy(Task $task)
    {
        $task->delete();

        return response(['message' => 'Task deleted successfully!']);
    }
}
