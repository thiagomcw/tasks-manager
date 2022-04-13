<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Models\Task;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;

class TaskControllerTest extends TestCase
{
    use DatabaseMigrations, WithFaker;

    public function testIndexSuccess()
    {
        $task = Task::factory()->create();

        $this
            ->sendIndexRequest()
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    '*' => [],
                ],
            ])
            ->assertJson([
                'data' => [
                    [
                        'id'        => $task->getKey(),
                        'title'     => $task->title,
                        'completed' => $task->completed,
                    ],
                ],
            ]);
    }

    public function testStoreValidationRequired()
    {
        $this
            ->sendStoreRequest()
            ->assertStatus(422)
            ->assertJsonStructure([
                'errors' => [
                    'title',
                ],
            ]);
    }

    public function testStoreValidationDetails()
    {
        $this
            ->sendStoreRequest([
                'title' => $this->faker->realTextBetween(),
            ])
            ->assertStatus(422)
            ->assertJsonStructure([
                'errors' => [
                    'title',
                ],
            ]);
    }

    public function testStoreSuccess()
    {
        $this
            ->sendStoreRequest([
                'title' => $this->faker->text(150),
            ])
            ->assertStatus(201)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'title',
                    'completed',
                ],
            ]);
    }

    public function testUpdateBinding404()
    {
        $this
            ->sendUpdateRequest()
            ->assertStatus(404);
    }

    public function testUpdateValidationRequired()
    {
        $task = Task::factory()->create();

        $this
            ->sendUpdateRequest($task->getKey())
            ->assertStatus(422)
            ->assertJsonStructure([
                'errors' => [
                    'completed',
                ],
            ]);
    }

    public function testUpdateValidationDetails()
    {
        $task = Task::factory()->create();

        $this
            ->sendUpdateRequest($task->getKey(), [
                'completed' => 'a',
            ])
            ->assertStatus(422)
            ->assertJsonStructure([
                'errors' => [
                    'completed',
                ],
            ]);
    }

    public function testUpdateSuccess()
    {
        $task = Task::factory()->create();

        $this
            ->sendUpdateRequest($task->getKey(), [
                'completed' => !$task->completed,
            ])
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'title',
                    'completed',
                ],
            ])
            ->assertJson([
                'data' => [
                    'completed' => !$task->completed,
                ],
            ]);

        $this->assertEquals(!$task->completed, $task->refresh()->completed);
    }

    public function testDestroyBinding404()
    {
        $this
            ->sendDestroyRequest()
            ->assertStatus(404);
    }

    public function testDestroySuccess()
    {
        $task = Task::factory()->create();

        $this
            ->sendDestroyRequest($task->getKey())
            ->assertStatus(200)
            ->assertJsonStructure(['message']);

        $this->assertDatabaseMissing(Task::class, [
            'id'         => $task->getKey(),
            'deleted_at' => null,
        ]);
    }

    private function sendIndexRequest(): TestResponse
    {
        return $this->json('GET', route('api.tasks.index'));
    }

    private function sendStoreRequest(array $data = []): TestResponse
    {
        return $this->json('POST', route('api.tasks.store'), $data);
    }

    private function sendUpdateRequest(int $taskId = 0, array $data = []): TestResponse
    {
        return $this->json('PUT', route('api.tasks.update', $taskId), $data);
    }

    private function sendDestroyRequest(int $taskId = 0): TestResponse
    {
        return $this->json('DELETE', route('api.tasks.update', $taskId));
    }
}
