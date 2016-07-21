<?php

use App\Team;
use App\User;
use Illuminate\Database\Seeder;

class TeamsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $teamOne = factory(Team::class)->create([
            'user_id' => 1,
        ]);

        $teamOne->add(User::where('id', '!=', 1)->take(2)->get());

        $teamTwo = factory(Team::class)->create([
            'user_id' => 2,
        ]);

        $teamTwo->add(User::where('id', '!=', 2)->take(4)->get());
    }
}
