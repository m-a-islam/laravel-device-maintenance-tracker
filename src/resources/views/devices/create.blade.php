@extends('layout')

@section('content')
    <div class="card">
        <h2>Create Device</h2>
        <form method="post" action="{{ route('devices.store') }}">
            @csrf
            <div class="field">
                <label>Name</label>
                <input name="name" value="{{ old('name') }}">
                @error('name') <div class="error">{{ $message }}</div> @enderror
            </div>
            <div class="field">
                <label>Serial number</label>
                <input name="serial_number" value="{{ old('serial_number') }}">
                @error('serial_number') <div class="error">{{ $message }}</div> @enderror
            </div>
            <div class="field">
                <label>Status</label>
                <select name="status">
                    <option value="active" {{ old('status')==='active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ old('status')==='inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
                @error('status') <div class="error">{{ $message }}</div> @enderror
            </div>
            <div class="actions">
                <button class="btn btn-primary">Save</button>
                <a class="btn" href="{{ route('devices.index') }}">Cancel</a>
            </div>
        </form>
    </div>
@endsection
