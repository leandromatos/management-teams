@if(auth()->check())
    <p>
        User: {{ auth()->user()->name }}<br>
        Roles (Permissions):
        @foreach(auth()->user()->roles as $role)
            {{ $role->name }} ({{ implode(', ', $role->permissions->pluck('name')->all()) }})<br>
        @endforeach
    </p>
@endif

@can('manage_founds')
    <hr>
    <a href="#">Manage Founds</a>
    <hr>
@endcan
