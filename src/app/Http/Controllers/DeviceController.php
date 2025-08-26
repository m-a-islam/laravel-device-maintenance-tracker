<?php

namespace App\Http\Controllers;

use App\Models\Device;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class DeviceController extends Controller
{
    public function index()
    {
        $q = request('q');
        $devices = Device::query()
            ->when($q, fn ($qq) => $qq->where('serial_number', 'like', "%{$q}%")
                ->orWhere('name', 'like', "%{$q}%"))
            ->latest()
            ->paginate(10);

        return view('devices.index', compact('devices', 'q'));
    }

    public function create()
    {
        return view('devices.create');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name'          => ['required','string','max:255'],
            'serial_number' => ['required','string','max:255','unique:devices,serial_number'],
            'status'        => ['required','in:active,inactive'],
        ]);

        Device::create($data);
        return redirect()->route('devices.index')->with('ok', 'Device created.');
    }

    public function edit(Device $device)
    {
        return view('devices.edit', compact('device'));
    }

    public function update(Request $request, Device $device)
    {
        $data = $request->validate([
            'name'          => ['required','string','max:255'],
            'serial_number' => ['required','string','max:255','unique:devices,serial_number,'.$device->id],
            'status'        => ['required','in:active,inactive'],
        ]);

        $device->update($data);
        return redirect()->route('devices.index')->with('ok', 'Device updated.');
    }

    public function destroy(Device $device)
    {
        $device->delete();
        return back()->with('ok', 'Device deleted.');
    }
}
