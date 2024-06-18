<?php

namespace Tests\Feature;

use App\Models\Plan;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ManagePlansTest extends TestCase
{
  use RefreshDatabase;
    public function test_a_user_can_create_a_plan(): void
    {
        $user=User::factory()->create();
        $this->actingAs($user)->post('/plans',$attributes=[
            'user_id'=>auth()->id(),
            'description'=>'something',
            'summation'=>'finished'
        ]);
        $this->assertDatabaseHas(Plan::class,$attributes);
    }

    public function test_unauthorized_user_can_not_create_a_project()
    {
        $this->post('/plans',$attributes=[
            'user_id'=>auth()->id(),
            'description'=>'something',
            'summation'=>'finished'
        ])->assertRedirect('/login');
    }

    public function test_a_plan_must_have_description()
    {
        $user=User::factory()->create();
        $this->actingAs($user)->post('/plans',$attributes=[
            'user_id'=>auth()->id(),
            'summation'=>'finished'
        ])->assertSessionHasErrors('description');

    }
    public function test_a_plan_must_have_summation()
    {
        $user=User::factory()->create();
        $this->actingAs($user)->post('/plans',$attributes=[
            'user_id'=>auth()->id(),
            'description'=>'something',
        ])->assertSessionHasErrors('summation');

    }
}
