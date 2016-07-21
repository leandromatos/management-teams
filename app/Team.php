<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'size', 'user_id',
    ];

    /**
     * Defines relationship for fetch owner of the team
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function owner()
    {
        return $this->hasOne(User::class);
    }

    /**
     * Defines relationship for fetch members of team
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function members()
    {
        return $this->belongsToMany(User::class);
    }

    /**
     * Add one or more users to the team
     *
     * @param \App\User|\Illuminate\Support\Collection $user
     */
    public function add($user)
    {
        $this->guardAgainstTooManyMembers();

        $method = $user instanceof User ? 'save' : 'saveMany';

        $this->members()->$method($user);
    }

    /**
     * Remove one or more users to the team
     *
     * @param  \App\User|\Illuminate\Support\Collection $user
     * @return int
     */
    public function remove($users)
    {
        if ($users instanceof User) {
            return $this->members()->detach($user->id);
        }

        return $this->members()->detach($users->pluck('id')->all());
    }

    /**
     * Remove all users to the team
     *
     * @return array
     */
    public function restart()
    {
        return $this->members()->sync([]);
    }

    /**
     * Returns quantity of users in the team
     *
     * @return int
     */
    public function count()
    {
        return $this->members()->count();
    }

    /**
     * Check if the team is owned by user
     *
     * @param  User $user
     *
     * @return boolean
     */
    public function isOwnedBy(User $user)
    {
        return $this->user_id == $user->id;
    }

    /**
     * Checked if the team is maxed out
     *
     * @return boolean
     */
    public function isMaxedOut()
    {
        return $this->count() >= $this->size;
    }

    /**
     * Guard against too many members of the team
     *
     * @return \Exception
     */
    protected function guardAgainstTooManyMembers()
    {
        if ($this->count() >= $this->size) {
            throw new \Exception();
        }
    }

}
