@include('partials.menu')

<h1>Edit <u>{{ $team->name }}</u> Team</h1>
<h3>Owner: {{ $team->owner()->lists('name') }}</h3>
<h3>Members: {{ implode(', ', $team->members()->pluck('name')->all()) }}</h3>
