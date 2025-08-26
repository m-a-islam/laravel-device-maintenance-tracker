@extends('layout')

@section('content')
    <div class="card">
        <div class="actions">
            <form method="get" action="{{ route('devices.index') }}" class="row" style="gap:.5rem; align-items:center">
                <input type="text" name="q" value="{{ $q }}" placeholder="Search name or serial…" style="max-width:280px">
                <button class="btn">Search</button>
                @if($q)
                    <a class="btn btn-link" href="{{ route('devices.index') }}">Clear</a>
                @endif
            </form>
            <a class="btn btn-primary right" href="{{ route('devices.create') }}">+ New Device</a>
        </div>
    </div>

    <div class="card">
        <table>
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Serial</th>
                <th>Status</th>
                <th class="muted">Tickets</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @forelse($devices as $d)
                <tr>
                    <td>#{{ $d->id }}</td>
                    <td>{{ $d->name }}</td>
                    <td>{{ $d->serial_number }}</td>
                    <td>{{ ucfirst($d->status) }}</td>
                    <td><a href="{{ route('tickets.index', $d) }}">View</a></td>
                    <td class="actions">
                        <a class="btn" href="{{ route('devices.edit', $d) }}">Edit</a>
                        <form method="post" action="{{ route('devices.destroy', $d) }}" class="inline" onsubmit="return confirm('Delete device? This also removes its tickets.');">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="6" class="muted">No devices found.</td></tr>
            @endforelse
            </tbody>
        </table>

        <div style="margin-top:.8rem">{{ $devices->withQueryString()->links() }}</div>
    </div>
@endsection
