@extends('layout')

@section('content')
    <div class="card">
        <div class="actions">
            <div>
                <strong>Device #{{ $device->id }}:</strong> {{ $device->name }}
                <span class="muted">({{ $device->serial_number }}, {{ $device->status }})</span>
            </div>
            <a class="btn btn-primary right" href="{{ route('tickets.create', $device) }}">+ New Ticket</a>
        </div>
    </div>

    <div class="card">
        <form method="get" action="{{ route('tickets.index', $device) }}" class="actions">
            <label>Filter</label>
            <select name="state" onchange="this.form.submit()">
                <option value="">All</option>
                <option value="open" {{ $state==='open' ? 'selected' : '' }}>Open</option>
                <option value="closed" {{ $state==='closed' ? 'selected' : '' }}>Closed</option>
            </select>
            @if($state)
                <a class="btn btn-link" href="{{ route('tickets.index', $device) }}">Clear</a>
            @endif
        </form>

        <table>
            <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th class="muted">State</th>
                <th class="muted">Created</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @forelse($tickets as $t)
                <tr>
                    <td>#{{ $t->id }}</td>
                    <td>{{ $t->title }}</td>
                    <td>{{ $t->state }}</td>
                    <td>{{ $t->created_at->format('Y-m-d H:i') }}</td>
                    <td class="actions">
                        @if($t->state === 'open')
                            <form method="post" action="{{ route('tickets.close', $t) }}" class="inline">
                                @csrf @method('PATCH')
                                <button class="btn">Close</button>
                            </form>
                        @endif
                        <form method="post" action="{{ route('tickets.destroy', $t) }}" class="inline" onsubmit="return confirm('Delete ticket?');">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5" class="muted">No tickets yet.</td></tr>
            @endforelse
            </tbody>
        </table>

        <div style="margin-top:.8rem">{{ $tickets->withQueryString()->links() }}</div>
    </div>

    <p><a href="{{ route('devices.index') }}">← Back to Devices</a></p>
@endsection
