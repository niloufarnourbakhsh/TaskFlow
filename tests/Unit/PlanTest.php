<?php

namespace Tests\Unit;

use App\Models\Category;
use App\Models\Plan;
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
}
