<?php

namespace Tests\Feature;

use App\Models\Activity;
use App\Models\Plan;
use App\Models\Task;
use App\Models\User;
use App\TaskStatus;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RecordeActivitiesTest extends TestCase
{
    use RefreshDatabase;

    public function test_an_activity_is_recorded_after_a_plan_is_created()
    {
        $plan=Plan::factory()->create();
        $this->assertCount(1,$plan->activities);
        $this->assertEquals('plan_created',$plan->activities->first()->description);
    }

    public function test_an_activity_is_created_after_adding_a_task()
    {
        $user=User::factory()->create();
        $plan=Plan::factory()->create(['user_id'=>$user->id]);
        $this->actingAs($user)->post('/tasks/'.$plan->id,[
            'body'=>'some task',
            'status'=>TaskStatus::NotDone->value,
        ]);
        $this->assertCount(2,Activity::all());
    }

    public function test_changing_the_task_status_adds_activity()
    {
        $task=Task::factory()->create();
        $this->actingAs($task->plan->user)->patch('/tasks/'.$task->id,[
            'status'=>TaskStatus::Doing->value
        ]);
        $this->assertCount(3,Activity::all());
    }

}
