@extends('layout')

@section('content')
    <div class="card">
        <h2>New Ticket for {{ $device->name }} ({{ $device->serial_number }})</h2>
        <form method="post" action="{{ route('tickets.store', $device) }}">
            @csrf
            <div class="field">
                <label>Title</label>
                <input name="title" value="{{ old('title') }}">
                @error('title') <div class="error">{{ $message }}</div> @enderror
            </div>
            <div class="field">
                <label>Description</label>
                <textarea name="description" rows="4">{{ old('description') }}</textarea>
                @error('description') <div class="error">{{ $message }}</div> @enderror
            </div>
            <div class="actions">
                <button class="btn btn-primary">Create</button>
                <a class="btn" href="{{ route('tickets.index', $device) }}">Cancel</a>
            </div>
        </form>
    </div>
@endsection
