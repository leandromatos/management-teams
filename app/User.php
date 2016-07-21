<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'permission',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Defines relationship for fetch teams user-owned
     *
     * @return @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ownedTeams()
    {
        return $this->hasMany(Team::class);
    }

    /**
     * Defines relationship for fetch teams that user participates
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function teamsParticipating()
    {
        return $this->belongsToMany(Team::class);
    }

    /**
     * Checks if the user is admin
     *
     * @return boolean
     */
    public function isAdmin()
    {
        return $this->permission == 'administrator';
    }
}
