<?php

namespace Tests\Feature;

use App\Models\Plan;
use App\Models\Task;
use App\Models\User;
use App\TaskStatus;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PlanTaskTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_plan_have_some_tasks()
    {
        $user=User::factory()->create();
        $plan=Plan::factory()->create(['user_id'=>$user->id]);
        $this->actingAs($user)->post('/tasks/'.$plan->id,$attributes=[
            'body'=>'some task',
            'status'=>TaskStatus::NotDone->value,
        ]);
        $this->assertCount(1,Task::all());
        $this->assertDatabaseHas(Task::class,$attributes);
    }

    public function test_only_authenticated_user_can_have_a_task()
    {
        $plan=Plan::factory()->create();
        $this->post('/tasks/'.$plan->id,$attributes=[
            'body'=>'some task',
            'status'=>TaskStatus::NotDone->value,
        ])->assertRedirect('login');
    }

    public function test_only_the_author_of_the_plan_can_add_task()
    {
        $plan=Plan::factory()->create();
        $this->actingAs(User::factory()->create())->post('/tasks/'.$plan->id,$attributes=[
            'body'=>'some task',
            'status'=>TaskStatus::NotDone->value,
        ])->assertStatus(403);
    }

    public function test_every_task_status_is_chosen_from_enums()
    {
        $user=User::factory()->create();
        $plan=Plan::factory()->create(['user_id'=>$user->id]);
        $this->actingAs($user)->post('/tasks/'.$plan->id,$attributes=[
            'body'=>'some task',
            'status'=>TaskStatus::NotDone->value,
        ])->assertRedirect($plan->path());
        $this->assertDatabaseHas(Task::class,$attributes);
    }

    public function test_the_body_of_the_task_is_required()
    {
        $user=User::factory()->create();
        $plan=Plan::factory()->create(['user_id'=>$user->id]);
        $this->actingAs($user)->post('/tasks/'.$plan->id,[
            'status'=>TaskStatus::NotDone->value,
        ])->assertSessionHasErrors('body');
    }

    public function test_it_fails_with_invalid_enums()
    {
        $user=User::factory()->create();
        $plan=Plan::factory()->create(['user_id'=>$user->id]);
        $this->actingAs($user)->post('/tasks/'.$plan->id,[
            'body'=>'some task',
            'status' => 'invalid_status',
        ])->assertSessionHasErrors('status');
    }

    public function test_users_can_update_task_status()
    {
        $task=Task::factory()->create();
        $this->actingAs($task->plan->user)->patch('/tasks/'.$task->id,[
            'status'=>TaskStatus::Doing->value
        ]);
        $this->assertDatabaseHas(Task::class,['status'=>TaskStatus::Doing->value]);
    }
    public function test_just_authenticated_user_Can_update_a_task()
    {
        $task=Task::factory()->create();
        $this->patch('/tasks/'.$task->id,[
            'status'=>TaskStatus::Doing->value
        ])->assertRedirect('login');
    }

    public function test_just_the_owner_of_the_plan_can_update_a_task()
    {
        $task=Task::factory()->create();
        $this->actingAs($user=User::factory()->create())->patch('/tasks/'.$task->id,[
            'status'=>TaskStatus::Doing->value
        ])->assertStatus(403);
    }

    public function test_a_task_may_be_deleted()
    {
        $task=Task::factory()->create();
        $this->assertCount(1,Task::all());
        $this->actingAs($task->plan->user)->delete('/tasks/'.$task->id)->assertRedirect('/');
        $this->assertCount(0,Task::all());
    }

    public function test_just_authenticated_user_delete_a_post()
    {
        $task=Task::factory()->create();
        $this->assertCount(1,Task::all());
        $this->delete('/tasks/'.$task->id)->assertRedirect('/login');
    }

    public function test_only_the_owner_of_the_plan_can_delete_the_post()
    {
        $task = Task::factory()->create();
        $this->actingAs(User::factory()->create())->delete('/tasks/' . $task->id)->assertStatus(403);
    }
}
