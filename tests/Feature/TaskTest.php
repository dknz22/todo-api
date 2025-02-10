<?php

namespace Tests\Feature;

use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    protected $user;
    protected $token;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->token = $this->user->createToken('test-token')->plainTextToken;
    }

    /** @test */
    public function user_can_create_task()
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->token,
        ])->postJson('/api/tasks', [
            'title' => 'Test Task',
            'description' => 'This is a test task',
            'completed' => false, // Добавляем поле completed
        ]);
    
        $response->assertStatus(201)
                 ->assertJsonStructure([
                     'id', 'title', 'description', 'completed', 'created_at', 'updated_at'
                 ]);
    }

    /** @test */
    public function user_can_get_tasks()
    {
        // Создаем задачу для текущего пользователя
        Task::factory()->create([
            'user_id' => $this->user->id,
        ]);

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->token,
        ])->getJson('/api/tasks');

        $response->assertStatus(200)
                ->assertJsonStructure([
                    '*' => ['id', 'title', 'description', 'completed', 'created_at', 'updated_at']
                ]);
    }

    /** @test */
    public function user_can_update_task()
    {
        // Создаем задачу для текущего пользователя
        $task = Task::factory()->create([
            'user_id' => $this->user->id,
        ]);

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->token,
        ])->putJson('/api/tasks/' . $task->id, [
            'title' => 'Updated Task Title',
            'completed' => true,
        ]);

        $response->assertStatus(200)
                ->assertJson([
                    'title' => 'Updated Task Title',
                    'completed' => true,
                ]);
    }

    /** @test */
    public function user_can_delete_task()
    {
        // Создаем задачу для текущего пользователя
        $task = Task::factory()->create([
            'user_id' => $this->user->id,
        ]);

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->token,
        ])->deleteJson('/api/tasks/' . $task->id);

        $response->assertStatus(204);
    }
}