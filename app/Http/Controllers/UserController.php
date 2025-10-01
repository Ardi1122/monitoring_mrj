<?php

namespace App\Http\Controllers;

use App\Models\Monitoring;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function showProfile()
    {
        $user = Auth::user()->load('identitas');
        $monitoring = Monitoring::where('ibu_hamil_id', $user->id)
            ->latest('tanggal')
            ->first();

        $mingguKe = null;
        $trimester = null;
         $perkiraanLahir = \Carbon\Carbon::parse($monitoring->tanggal)
            ->addWeeks(40 - $monitoring->usia_kehamilan)
            ->format('d F Y');

        if ($monitoring) {
            $mingguKe = $monitoring->usia_kehamilan;

            // Logika pembagian trimester
            if ($mingguKe >= 1 && $mingguKe <= 12) {
                $trimester = "Trimester 1";
            } elseif ($mingguKe >= 13 && $mingguKe <= 27) {
                $trimester = "Trimester 2";
            } elseif ($mingguKe >= 28) {
                $trimester = "Trimester 3";
            } else {
                $trimester = "Belum masuk perhitungan trimester";
            }
        }

        return view('ibu_hamil.settings', compact('user', 'monitoring', 'mingguKe', 'trimester', 'perkiraanLahir'));
    }
}
