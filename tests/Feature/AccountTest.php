<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AccountTest extends TestCase
{
    use RefreshDatabase;

    protected $user;

    public function setUp()
    {
        parent::setUp();

        $this->user = factory(User::class)->create([
            'name' => 'testName',
            'email' => 'test@domain.com'
        ]);
    }

    public function testGetSettingsPage()
    {
        $response = $this->actingAs($this->user)->get(route('account.edit'));

        $response->assertOk();
    }

    public function testAccountDelete()
    {
        $this->assertDatabaseHas('users', ['name' => 'testName']);
        $response = $this->actingAs($this->user)->call('DELETE', route('account.destroy'));
        $this->assertDatabaseMissing('users', ['name' => 'testName']);
    }

    public function testAccountUpdate()
    {
        $this->assertDatabaseHas('users', ['name' => 'testName', 'email' => 'test@domain.com']);
        $this->actingAs($this->user)->call(
            'PUT',
            route('account.update'),
            ['name' => 'newName', 'email' => 'newEmail@domain.com']
        );
        $this->assertDatabaseHas('users', ['name' => 'newName', 'email' => 'newEmail@domain.com']);
    }

    public function testAccountChangePassword()
    {
        $response = $this->actingAs($this->user)->post(route('password.email'));

        $response->assertSessionHasNoErrors();
    }
}
