<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    // List tickets for a device, optional state filter
    public function index(Device $device)
    {
        $state = request('state');
        $tickets = $device->tickets()
            ->when($state, fn ($q) => $q->where('state', $state))
            ->latest()
            ->paginate(10);

        return view('tickets.index', compact('device', 'tickets', 'state'));
    }

    public function create(Device $device)
    {
        return view('tickets.create', compact('device'));
    }

    public function store(Request $request, Device $device)
    {
        $data = $request->validate([
            'title'       => ['required','string','max:255'],
            'description' => ['nullable','string'],
        ]);

        $device->tickets()->create($data); // state defaults to 'open'
        return redirect()->route('tickets.index', $device)->with('ok', 'Ticket created.');
    }

    public function close(Ticket $ticket)
    {
        $ticket->update(['state' => 'closed']);
        return back()->with('ok', 'Ticket closed.');
    }

    public function destroy(Ticket $ticket)
    {
        $ticket->delete();
        return back()->with('ok', 'Ticket deleted.');
    }
}
