<?php

namespace App\Policies;

use App\Team;
use App\User;
use Gate;
use Illuminate\Auth\Access\HandlesAuthorization;

class TeamPolicy
{
    use HandlesAuthorization;

    /**
     * Policy to allow only the owner of the team can update it
     *
     * @param  \App\User   $user
     * @param  \App\Team   $team
     * @return boolean
     */
    public function edit(User $user, Team $team)
    {
        if (Gate::check('edit_team')) {
            return true;
        }

        if (!$team->isOwnedBy($user)) {
            abort(403, 'You are not the owner of this team.');
        }

        if ($team->isMaxedOut($user)) {
            abort(403, 'Your team is maxed out.');
        }

        return true;
    }
}
