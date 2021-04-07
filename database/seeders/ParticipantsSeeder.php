<?php

namespace Database\Seeders;

use App\Models\Participant;
use Illuminate\Database\Seeder;

class ParticipantsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Participant::factory()->times(50)->create();
    }
}
