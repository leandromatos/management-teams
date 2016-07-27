@include('partials.menu')

<h1>Show <u>{{ $team->name }}</u> Team</h1>
<h3>Owner: {{ $team->owner()->lists('name') }}</h3>
<h3>Members: {{ implode(', ', $team->members()->pluck('name')->all()) }}</h3>

@if(auth()->check() && (auth()->user()->can('edit_team') || $team->isOwnedBy(auth()->user())))
    <h3><a href="{{ route('team.edit', $team) }}">Edit team</a></h3>
@endif
