<?php

namespace Tests\Feature;

use App\Models\Category;
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
        $user = User::factory()->create();
        $category=Category::factory()->create();
        $this->actingAs($user)->post('/plans', $attributes = [
            'category_id'=>$category->id,
            'description' => 'something',
            'summation' => 'finished'
        ]);
        $this->assertDatabaseHas(Plan::class, $attributes);
    }

    public function test_unauthorized_user_can_not_create_a_project()
    {
        $this->post('/plans', $attributes = [
            'user_id' => auth()->id(),
            'category_id'=>Category::factory()->create(),
            'description' => 'something',
            'summation' => 'finished'
        ])->assertRedirect('/login');
    }

    public function test_a_plan_must_have_description()
    {
        $user = User::factory()->create();
        $this->actingAs($user)->post('/plans', $attributes = [
            'user_id' => auth()->id(),
            'category_id'=>Category::factory()->create(),
            'summation' => 'finished'
        ])->assertSessionHasErrors('description');
    }

    public function test_a_plan_must_have_summation()
    {
        $user = User::factory()->create();
        $this->actingAs($user)->post('/plans', [
            'category_id'=>Category::factory()->create(),
            'description' => 'something',
            'summation' =>''
        ])->assertSessionHasErrors('summation');
    }

    public function test_a_plan_must_belongs_to_a_category()
    {
        $user = User::factory()->create();
        $this->actingAs($user)->post('/plans', $attributes = [
            'user_id' => auth()->id(),
            'description' => 'something',
        ])->assertSessionHasErrors('category_id');
    }

    public function test_a_user_can_see_all_of_their_plans()
    {
        $user=User::factory()->create();
        $plan=Plan::factory()->create(['user_id'=>$user->id]);
        $this->actingAs($user)->get($plan->path())
            ->assertSee($plan->id)
            ->assertSee($plan->description);
    }

    public function test_an_unauthenticated_user_can_not_see_the_plan_of_others()
    {
        $plan=Plan::factory()->create();
        $this->actingAs(User::factory()->create())->get($plan->path())
            ->assertStatus(403);
    }

    public function test_a_user_can_update_their_plans()
    {
        $user = User::factory()->create();
        $this->actingAs($user)->post('/plans', $attributes = [
            'category_id'=>$category=Category::factory()->create()->id,
            'description' => 'something',
            'summation' => 'finished'
        ]);
        $this->assertDatabaseHas(Plan::class,$attributes);
        $plan=Plan::first();
        $this->actingAs($user)->put($plan->path(), $attributes = [
            'category_id'=>$category,
            'description' => 'edited',
            'summation' => 'edited'
        ]);
        $this->assertDatabaseHas(Plan::class,$attributes);
    }

    public function test_an_unauthorize_user_can_not_update_the_plan()
    {
        $plan=Plan::factory()->create();
        $this->patch($plan->path(),$attributes=[
            'description' => 'edited',
            'summation' => 'edited'
        ])->assertRedirect('login');
        $this->assertDatabaseMissing(Plan::class,$attributes);
    }

    public function test_a_user_can_not_update_other_person_plans()
    {
        $plan=Plan::factory()->create();
        $user = User::factory()->create();
        $this->actingAs($user)->patch($plan->path(),[
            'description' => 'edited',
            'summation' => 'edited'
        ])->assertStatus(403);
    }

    public function test_a_user_can_delete_their_own_plan()
    {

        $user=User::factory()->create();
        $plan=Plan::factory()->create(['user_id'=>$user->id]);
        $this->actingAs($user)->delete($plan->path());
        $this->assertCount(0,Plan::all());
        $this->assertDatabaseMissing(Plan::class,$plan->only($plan->id));
    }
    public function test_only_authenticated_user_can_delete_a_plan()
    {
        $plan=Plan::factory()->create();
        $this->delete($plan->path())
        ->assertRedirect('/login');
    }

    public function test_a_user_just_can_delete_the_plan_of_their_own()
    {

        $plan=Plan::factory()->create();
        $this->actingAs(User::factory()->create())->delete($plan->path())
        ->assertStatus(403);
    }

}
