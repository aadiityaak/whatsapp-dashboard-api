<?php

namespace App\Http\Controllers\Api;

use App\Models\WhatsappSession;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WhatsappSessionController extends Controller
{
    public function index()
    {
        return WhatsappSession::all();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'session_id' => 'required|string|unique:whatsapp_sessions,session_id',
        ]);

        $session = WhatsappSession::create($data);
        return response()->json($session);
    }

    public function updateStatus(Request $request, $sessionId)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,connected,disconnected'
        ]);

        $session = WhatsappSession::updateOrCreate(
            ['session_id' => $sessionId],
            ['status' => $validated['status']]
        );

        return response()->json([
            'message' => 'Status updated',
            'data' => $session
        ]);
    }
}
