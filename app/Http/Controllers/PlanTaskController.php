<?php

namespace App\Http\Controllers;

use App\Http\Requests\PlanTaskRequest;
use App\Models\Plan;
use App\Models\Task;
use App\TaskStatus;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class PlanTaskController extends Controller
{
    use AuthorizesRequests;
    public function store(PlanTaskRequest $request,Plan $plan)
    {
        $this->authorize('update',$plan);
        $plan->tasks()->create([
            'body'=>$request->body,
            'status'=>TaskStatus::from($request->status),
        ]);
      return redirect($plan->path());
    }

    public function update(Task $task,Request $request)
    {
        $this->authorize('update',$task->plan);
        $task->update(['status'=>TaskStatus::from($request->status)]);
        return redirect()->back();
    }

    public function delete(Task $task)
    {
        $this->authorize('update',$task->plan);
        $task->delete();
        return redirect()->back();
    }
}
