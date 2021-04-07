<?php

namespace Database\Factories;

use App\Models\Attachment;
use App\Models\Chat;
use App\Models\Message;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class MessageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Message::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'text' => $this->faker->text,
            'attachment_id' => Attachment::factory(),
            'user_id' => User::factory(),
            'chat_id' => Chat::factory(),
            'status' => $this->faker->numberBetween($min = 0, $max = 1),
            'created_at' => $this->faker->date(),
            'updated_at' => $this->faker->date()
        ];
    }
}
