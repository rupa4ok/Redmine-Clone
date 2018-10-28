<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class GuestTest extends TestCase
{
    use RefreshDatabase;

    public function testGetHelloPage()
    {
        $response = $this->get(route('index'));

        $response->assertOk();
    }

    public function testGetMembers()
    {
        $user = factory(User::class)->create([
            'name' => 'testName',
            'email' => 'testEmail@domain.com'
        ]);
        $response = $this->get(route('members'));
        $response->assertSeeInOrder(['testName','testEmail@domain.com']);
    }
}
