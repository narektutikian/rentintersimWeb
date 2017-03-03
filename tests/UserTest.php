<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\User;

class UserTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $user = User::find(30);
       $this->actingAs($user)
            ->visit('/user-tree')
            ->assertResponseStatus(200);

    }

    public function testQueue()
    {
        $this->visit('/test-user-queue');
    }
}
