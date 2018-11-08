<?php

namespace Tests\Feature;

use App\Task;
use App\TaskStatus;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TaskTest extends TestCase
{
    use RefreshDatabase;
    protected $user;
    protected $taskStatus;
    protected $task;

    public function setUp()
    {
        parent::setUp();
        $this->user = factory(User::class)->create(['name' => 'testName']);
        $this->taskStatus = factory(TaskStatus::class)->create(['name' => 'testStatus']);
        $this->task = factory(Task::class)->create([
            'name' => 'testTask',
            'description' => 'testDescription',
            'status_id' => $this->taskStatus->id,
            'executor_id' => $this->user->id,
            'creator_id' => $this->user->id
        ]);
    }

    public function testGetTasksList()
    {
        $response = $this->actingAs($this->user)->get(route('tasks.index'));

        $response->assertOk();
    }

    public function testGetTaskCreatePage()
    {
        $response = $this->actingAs($this->user)->get(route('tasks.create'));

        $response->assertOk();
    }

    public function testStoreTask()
    {
        $response = $this->actingAs($this->user)->post(
            route(
                'tasks.store',
                [
                    'name' => 'testTask',
                    'description' => 'descriptionTest',
                    'status_id' => $this->taskStatus->id,
                    'executor_id' => $this->user->id
                ]
            )
        );

        $this->assertDatabaseHas(
            'tasks',
            [
                'name' => 'testTask',
                'description' => 'descriptionTest',
                'creator_id' => $this->user->id,
                'executor_id' => $this->user->id,
                'status_id' => $this->taskStatus->id
            ]
        );
    }

    public function testGetTaskPage()
    {

        $response = $this->actingAs($this->user)->get(route('tasks.show', $this->task->id));
        $response->assertOk();
    }

    public function testGetTaskEditPage()
    {
        $response = $this->actingAs($this->user)->get(route('tasks.edit', $this->task->id));

        $response->assertOk();
    }

    public function testTaskUpdate()
    {
        $newUser = factory(User::class)->create();
        $newTaskStatus = factory(TaskStatus::class)->create();
        $this->actingAs($this->user)->call(
            'PUT',
            route('tasks.update', $this->task->id),
            [
                'name' => 'newName',
                'description' => 'newDescription',
                'status_id' => $newTaskStatus->id,
                'executor_id' => $newUser->id
            ]
        );

        $this->assertDatabaseHas(
            'tasks',
            [
                'name' => 'newName',
                'description' => 'newDescription',
                'executor_id' => $newUser->id,
                'status_id' => $newTaskStatus->id
            ]
        );
    }
}
