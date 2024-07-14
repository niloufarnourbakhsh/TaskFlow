<?php

namespace App\Http\Controllers;

use App\Http\Requests\PlanRequest;
use App\Models\Plan;

use App\TaskStatus;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;


class PlanController extends Controller
{
    use AuthorizesRequests;

    /**
     * Display a listing of the resource.
     */
    public function index():View
    {

        $plans=Plan::where(['user_id'=>\auth()->id()])->get();
        return view('Plan.index')->with('plans',$plans);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Plan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PlanRequest $request)
    {
        Auth::user()->plans()->create($request->all());
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Plan $plan)
    {
        $this->authorize('update',$plan);
        $statuses=TaskStatus::cases();
       return view('Plan.show')->with('plan',$plan)->with('statuses',$statuses);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Plan $plan)
    {
//        $this->authorize('update',$id);
        return \view('Plan.edit')->with('plan',$plan);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Plan $plan)
    {
        $this->authorize('update',$plan);
        $plan->update($request->all());
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Plan $plan)
    {
        $this->authorize('update',$plan);
        $plan->delete();
        return redirect()->back();
    }
}
