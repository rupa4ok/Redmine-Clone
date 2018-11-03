<?php

namespace Tests\Feature;

use App\User;
use App\TaskStatus;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TaskStatusTest extends TestCase
{
    use RefreshDatabase;

    protected $user;
    protected $taskStatus;
    protected $taskId;

    public function setUp()
    {
        parent::setUp();

        $this->user = factory(User::class)->create();
        $this->taskStatus = factory(TaskStatus::class)->create([
            'name' => 'testStatus'
        ]);
        $this->taskId = $this->taskStatus->id;
    }

    public function testGetTaskStatusList()
    {
        $response = $this->actingAs($this->user)->get(route('statuses.index'));

        $response->assertOk();
    }

    public function testGetTaskStatusCreatePage()
    {
        $response = $this->actingAs($this->user)->get(route('statuses.create'));

        $response->assertOk();
    }

    public function testStoreTaskStatus()
    {
        $response = $this->actingAs($this->user)->post(route('statuses.store'), ['name' => 'testTag']);

        $this->assertDatabaseHas('task_statuses', ['name' => 'testTag']);
    }

    public function testGetTaskStatusEditPage()
    {
        $response = $this->actingAs($this->user)->get(route('statuses.edit', $this->taskId));
        $response->assertOk();
    }

    public function testUpdateTaskStatus()
    {
        $this->actingAs($this->user)->call(
            'PUT',
            route('statuses.update', $this->taskId),
            ['name' => 'newTestName']
        );
        $this->assertDatabaseHas('task_statuses', ['name' => 'newTestName']);
    }

    public function testDeleteTaskStatus()
    {
        $this->actingAs($this->user)->call(
            'DELETE',
            route('statuses.destroy', $this->taskId)
        );
        $this->assertDatabaseMissing('task_statuses', ['name' => 'testStatus']);
    }
}
