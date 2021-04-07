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
            'chat' => Chat::factory(),
            'folder' => $this->faker->name,
            'owner' => User::factory()
        ];
    }
}
