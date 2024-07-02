<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\Task;
use Illuminate\Http\Request;

class PlanTaskController extends Controller
{
    public function store(Request $request,Plan $plan)
    {
        $plan->tasks()->create([
            'body'=>$request->body,
            'status'=>$request->status,
        ]);
    }
}
