<?php

namespace App\Policies;

use App\Models\Plan;
use App\Models\User;

class PlanPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function show(User $user,Plan $plan):bool
    {
        return $user->is($plan->user);
    }
    public function update(User $user,Plan $plan):bool
    {
        return $user->is($plan->user);
    }
}
