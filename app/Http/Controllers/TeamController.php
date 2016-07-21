<?php

namespace App\Http\Controllers;

use App\Team;

class TeamController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  \App\Team $team
     * @return \Illuminate\Http\Response
     */
    public function show(Team $team)
    {
        return view('team.show')->with(compact('team'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Team $team
     * @return \Illuminate\Http\Response
     */
    public function edit(Team $team)
    {
        $this->authorize($team);

        return view('team.edit')->with(compact('team'));
    }
}
