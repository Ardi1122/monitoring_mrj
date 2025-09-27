<?php

namespace App\Http\Controllers;

use App\Models\PregnancyLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PregnancyLogController extends Controller
{
    public function index()
    {
        $logs = PregnancyLog::where('ibu_hamil_id', Auth::id())
            ->orderBy('tanggal', 'desc')
            ->get();

        return view('ibu_hamil.log', compact('logs'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
        'symptoms' => 'required',
        'mood' => 'required',
        'appetite' => 'required',
        'notes' => 'nullable|string',
    ]);

    $log = PregnancyLog::create([
        'ibu_hamil_id' => Auth::id(),
        'tanggal' => now(),
        'symptoms' => $data['symptoms'],
        'mood' => $data['mood'],
        'appetite' => $data['appetite'],
        'notes' => $data['notes'],
    ]);

    return response()->json([
        'success' => true,
        'log' => $log
    ]);
    }
}
