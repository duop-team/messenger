<?php

namespace Database\Factories;

use App\Models\Chat;
use App\Models\Media;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ChatFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Chat::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'about' => $this->faker->text(30),
            'user_id' => User::factory(),
            'media_id' => Media::factory(),
            'created_at' => $this->faker->time(),
            'updated_at' => $this->faker->time()
        ];
    }
}
