@extends('layout')

@section('content')
    <div class="card">
        <h2>Edit Device #{{ $device->id }}</h2>
        <form method="post" action="{{ route('devices.update', $device) }}">
            @csrf @method('PUT')
            <div class="field">
                <label>Name</label>
                <input name="name" value="{{ old('name', $device->name) }}">
                @error('name') <div class="error">{{ $message }}</div> @enderror
            </div>
            <div class="field">
                <label>Serial number</label>
                <input name="serial_number" value="{{ old('serial_number', $device->serial_number) }}">
                @error('serial_number') <div class="error">{{ $message }}</div> @enderror
            </div>
            <div class="field">
                <label>Status</label>
                <select name="status">
                    @foreach(['active','inactive'] as $opt)
                        <option value="{{ $opt }}" {{ old('status', $device->status)===$opt ? 'selected' : '' }}>{{ ucfirst($opt) }}</option>
                    @endforeach
                </select>
                @error('status') <div class="error">{{ $message }}</div> @enderror
            </div>
            <div class="actions">
                <button class="btn btn-primary">Update</button>
                <a class="btn" href="{{ route('devices.index') }}">Back</a>
            </div>
        </form>
    </div>
@endsection
