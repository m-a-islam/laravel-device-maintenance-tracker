<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Device;
use Illuminate\Http\Request;

class TicketApiController extends Controller
{
    // GET /api/devices/{device}/tickets?state=open|closed
    public function index(Device $device, Request $request)
    {
        $state = $request->query('state');
        if ($state && !in_array($state, ['open','closed'], true)) {
            return response()->json(['message' => 'Invalid state'], 422);
        }

        $tickets = $device->tickets()
            ->when($state, fn ($q) => $q->where('state', $state))
            ->latest()
            ->get(['id','title','description','state','created_at']);

        return response()->json(['data' => $tickets]);
    }

    // POST /api/devices/{device}/tickets
    public function store(Device $device, Request $request)
    {
        $data = $request->validate([
            'title'       => ['required','string','max:255'],
            'description' => ['nullable','string'],
        ]);

        $ticket = $device->tickets()->create($data);

        return response()->json(['data' => $ticket], 201);
    }
}
