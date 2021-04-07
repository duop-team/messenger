<?php

namespace Database\Factories;

use App\Models\Chat;
use App\Models\Folder;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class FolderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Folder::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'chat_id' => Chat::factory(),
            'folder' => $this->faker->name,
            'user_id' => User::factory()
        ];
    }
}
