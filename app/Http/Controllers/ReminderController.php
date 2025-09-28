<?php

namespace App\Http\Controllers;

use App\Models\Reminder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReminderController extends Controller
{
    public function index()
    {
        $todayReminders = Reminder::where('ibu_hamil_id', Auth::id())
            ->whereDate('tanggal', today())
            ->orderBy('tanggal', 'asc')
            ->limit(3)
            ->get();

        $allReminders = Reminder::where('ibu_hamil_id', Auth::id())
            ->orderBy('tanggal', 'asc')
            ->get();

        return view('ibu_hamil.dashboard', compact('todayReminders', 'allReminders'));
    }
}
