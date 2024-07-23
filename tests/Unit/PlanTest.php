<?php

namespace Tests\Unit;

use App\Models\Category;
use App\Models\Plan;
use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PlanTest extends TestCase
{
    use RefreshDatabase;

    public function test_every_plan_has_a_category()
    {
        $plan=Plan::factory()->create();
        $this->assertInstanceOf(Category::class,$plan->category);
    }

    public function test_every_plan_belongs_to_a_user()
    {
        $plan=Plan::factory()->create();
        $this->assertInstanceOf(User::class,$plan->user);
    }

    public function test_plan_has_a_path()
    {
        $plan=Plan::factory()->create();
        $this->assertEquals($plan->path(),'/plans/'.$plan->id);
    }

    public function test_a_plan_has_tasks()
    {
        $this->withoutExceptionHandling();
        $plan=Plan::factory()->create();
        $task=Task::factory()->create(['plan_id'=>$plan->id]);
        $this->assertTrue($plan->tasks->contains($task));
    }
}
