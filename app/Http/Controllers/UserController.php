<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Monitoring;
use App\Models\Logbook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class UserController extends Controller
{
    private function getTrimesterData($monitoring)
    {
        if (!$monitoring) {
            return [
                'mingguKe' => null,
                'trimester' => 'Belum ada data',
                'perkiraanLahir' => null
            ];
        }

        $mingguKe = $monitoring->usia_kehamilan;

        // Hitung perkiraan lahir (40 minggu - usia kehamilan saat ini)
        $perkiraanLahir = Carbon::parse($monitoring->tanggal)
            ->addWeeks(40 - $mingguKe)
            ->format('d F Y');

        // Tentukan trimester
        if ($mingguKe >= 1 && $mingguKe <= 12) {
            $trimester = "Trimester 1";
        } elseif ($mingguKe >= 13 && $mingguKe <= 27) {
            $trimester = "Trimester 2";
        } elseif ($mingguKe >= 28) {
            $trimester = "Trimester 3";
        } else {
            $trimester = "Belum masuk perhitungan trimester";
        }

        return compact('mingguKe', 'trimester', 'perkiraanLahir');
    }

    private function getLogbookSummary($userId)
    {
        $totalKonseling = Logbook::where('ibu_hamil_id', $userId)->count();

        $konselingTerakhir = Logbook::where('ibu_hamil_id', $userId)
            ->latest('tanggal')
            ->value('tanggal');

        return [
            'totalKonseling' => $totalKonseling,
            'konselingTerakhir' => $konselingTerakhir
                ? Carbon::parse($konselingTerakhir)->format('d M Y')
                : '-'
        ];
    }

    public function showProfile()
    {
        $user = User::with('identitas')->find(Auth::id());

        $monitoring = Monitoring::where('ibu_hamil_id', $user->id)
            ->latest('tanggal')
            ->first();

        // Ambil data trimester
        $trimesterData = $this->getTrimesterData($monitoring);

        // Ambil ringkasan logbook
        $logbookSummary = $this->getLogbookSummary($user->id);

        $status = $monitoring ? $this->getStatusKehamilan($monitoring) : null;
        $badgeColor = $status ? $this->getBadgeColor($status) : 'primary';

        return view('ibu_hamil.settings', [
            'user' => $user,
            'status' => $status,
            'badgeColor' => $badgeColor,   
            'monitoring' => $monitoring,
            'mingguKe' => $trimesterData['mingguKe'],
            'trimester' => $trimesterData['trimester'],
            'perkiraanLahir' => $trimesterData['perkiraanLahir'],
            'totalKonseling' => $logbookSummary['totalKonseling'],
            'konselingTerakhir' => $logbookSummary['konselingTerakhir'],
        ]);
    }

    public function getStatusKehamilan($record)
    {
        $sistolik  = $record->tekanan_darah_sistolik ?? 0;
        $diastolik = $record->tekanan_darah_diastolik ?? 0;
        $lila      = $record->lila ?? 0;
        $hb        = $record->hb ?? 0;
        // $tinggi    = $record->tinggi_badan ?? 160;

        // Status Tinggi jika salah satu kritis
        if ($hb < 11 || $sistolik >= 140 || $diastolik >= 90 || $lila < 23) {
            return 'Tinggi';
        }

        // Status Sedang jika ada peringatan ringan
        if ($hb < 12 || $sistolik >= 130 || $diastolik >= 85 || $lila < 25) {
            return 'Sedang';
        }

        // Normal / Rendah
        return 'Rendah';
    }

    public function getBadgeColor($status)
    {
        return match ($status) {
            'Tinggi' => 'danger',
            'Sedang' => 'warning',
            'Rendah' => 'success',
            default => 'primary',
        };
    }
}
