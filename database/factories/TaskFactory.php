<?php

namespace Database\Factories;

use App\Models\Task;
use Illuminate\Database\Eloquent\Factories\Factory;

class TaskFactory extends Factory
{
    protected $model = Task::class;

    public function definition(): array
    {
        return [
            'title'     => fn() => $this->faker->text(150),
            'completed' => fn() => $this->faker->boolean(),
        ];
    }
}
