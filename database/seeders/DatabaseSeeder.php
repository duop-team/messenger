<?php

namespace Database\Seeders;

use App\Models\AccessRule;
use App\Models\Folder;
use App\Models\Media;
use App\Models\Participant;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            MediaSeeder::class,
            UsersSeeder::class,
            AttachmentsSeeder::class,
            ChatsSeeder::class,
            FoldersSeeder::class,
            MessagesSeeder::class,
            AccessRulesSeeder::class,
            ParticipantsSeeder::class
        ]);
    }
}
