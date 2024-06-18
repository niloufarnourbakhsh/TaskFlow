<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Collection;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;
    public function test_a_user_can_have_plans()
    {
        $user=User::factory()->create();
        $this->assertInstanceOf(Collection::class,$user->plans);
    }
}
