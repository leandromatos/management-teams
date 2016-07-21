<?php

use App\Team;
use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TeamTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function a_team_owner_can_add_members()
    {
        $userOne = factory(User::class)->create();

        $team = factory(Team::class)->create([
            'user_id' => $userOne->id,
        ]);

        $userTwo = factory(User::class)->create();

        $team->add($userTwo);

        $this->assertEquals(1, $team->count());
    }

    /** @test */
    public function a_team_owner_can_add_multiple_members_at_once()
    {
        $userOne = factory(User::class)->create();

        $team = factory(Team::class)->create([
            'user_id' => $userOne->id,
        ]);

        $threeUsers = factory(User::class, 3)->create();

        $team->add($threeUsers);

        $this->assertEquals(3, $team->count());
    }

    /** @test */
    public function a_team_owner_has_a_maximum_size()
    {
        $userOne = factory(User::class)->create();

        $team = factory(Team::class)->create([
            'user_id' => $userOne->id,
            'size'    => 6,
        ]);

        $threeUsers = factory(User::class, 3)->create();
        $team->add($threeUsers);

        $moreThreeUsers = factory(User::class, 3)->create();
        $team->add($moreThreeUsers);

        $this->assertEquals(6, $team->count());
        $this->setExpectedException('Exception');

        $moreOneUser = factory(User::class)->create();

        $team->add($moreOneUser);
    }

    /** @test */
    public function a_team_owner_can_remove_a_member()
    {
        $userOne = factory(User::class)->create();

        $team = factory(Team::class)->create([
            'user_id' => $userOne->id,
        ]);

        $users = factory(User::class, 3)->create();

        $team->add($users);

        $team->remove($users[0]);

        $this->assertEquals(2, $team->count());
    }

    /** @test */
    public function a_team_owner_can_remove_more_than_one_member_at_once()
    {
        $user = factory(User::class)->create();

        $team = factory(Team::class)->create([
            'user_id' => $user->id,
            'size'    => 3,
        ]);

        $users = factory(User::class, 3)->create();

        $team->add($users);

        $team->remove($users->slice(0, 2));

        $this->assertEquals(1, $team->count());
    }

    /** @test */
    public function a_team_owner_can_remove_all_members_at_once()
    {
        $user = factory(User::class)->create();

        $team = factory(Team::class)->create([
            'user_id' => $user->id,
        ]);

        $users = factory(User::class, 3)->create();

        $team->add($users);

        $team->restart();

        $this->assertEquals(0, $team->count());
    }
}
