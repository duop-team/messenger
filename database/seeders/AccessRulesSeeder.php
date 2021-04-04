<?php

namespace Database\Seeders;

use App\Models\AccessRule;
use Illuminate\Database\Seeder;

class AccessRulesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AccessRule::factory()->times(10)->create();
    }
}
