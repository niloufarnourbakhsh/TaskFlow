<?php

namespace Tests\Unit;

use App\Models\Plan;
use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_task_belongs_to_a_plan()
    {
        $task=Task::factory()->create();
        $this->assertInstanceOf(Plan::class,$task->plan);
    }
}
