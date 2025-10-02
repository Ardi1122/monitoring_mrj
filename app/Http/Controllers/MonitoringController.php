<?php

namespace App\Http\Controllers;

use App\Models\Reminder;
use App\Models\Monitoring;
use App\Models\MrjTracker;
use Illuminate\Http\Request;
use App\Models\IbuHamilMrjTracker;
use Illuminate\Support\Facades\Auth;

class MonitoringController extends Controller
{
    // Tampilkan dashboard dengan data terakhir
    public function index()
    {
        // Ambil user yang login
        $user = Auth::user();

        // Ambil monitoring terakhir untuk user itu
        $monitoring = Monitoring::where('ibu_hamil_id', $user->id)
            ->latest('tanggal')
            ->first();

        // Reminder hari ini
        $todayReminders = Reminder::where('ibu_hamil_id', $user->id)
            ->whereDate('tanggal', today())
            ->orderBy('tanggal', 'asc')
            ->limit(3)
            ->get();

        // Semua reminder untuk modal
        $allReminders = Reminder::where('ibu_hamil_id', $user->id)
            ->orderBy('tanggal', 'asc')
            ->get();

        $status = $monitoring ? $this->getStatusKehamilan($monitoring) : null;
        $badgeColor = $status ? $this->getBadgeColor($status) : 'primary';
        $stokKader = MrjTracker::where('stok_sisa', '>', 0)->get();

        // Ambil catatan MRJ terakhir untuk ibu hamil
        $lastMRJ = IbuHamilMrjTracker::where('ibu_hamil_id', $user->id)
            ->latest('tanggal')
            ->first();

        $targetHarian = $lastMRJ ? $lastMRJ->target_harian : 0;
        $konsumsiHarian = $lastMRJ ? $lastMRJ->konsumsi_harian : 0;


        return view('ibu_hamil.dashboard', compact('user', 'monitoring', 'status', 'badgeColor', 'stokKader', 'todayReminders', 'allReminders', 'targetHarian', 'konsumsiHarian'));
    }

    public function completeReminder(Reminder $reminder)
    {
        // pastikan hanya ibu hamil pemilik reminder yg bisa update
        if ($reminder->ibu_hamil_id !== Auth::user()->id) {
            abort(403, 'Unauthorized');
        }

        $reminder->update([
            'status' => 'done',
        ]);

        return redirect()->back()->with('success', 'Reminder berhasil ditandai selesai.');
    }

    public function monitoring()
    {
        $user = Auth::user();

        $monitorings = Monitoring::where('ibu_hamil_id', $user->id)
            ->orderBy('tanggal', 'asc')
            ->get();

        $latest = $monitorings->last();
        $status = $latest ? $this->getStatusKehamilan($latest) : null;
        $badgeColor = $status ? $this->getBadgeColor($status) : 'primary';

        $maxWeight = $monitorings->max('berat_badan') ?: 1; // supaya nggak bagi 0
        $maxLila = $monitorings->max('lila') ?: 1;
        $maxHb = $monitorings->max('hb') ?: 1;

        $weightData = $monitorings->map(function ($row) use ($maxWeight) {
            return [
                'week' => $row->usia_kehamilan . 'w',
                'value' => $row->berat_badan,
                'percentage' => ($row->berat_badan / $maxWeight) * 100,
                'date' => \Carbon\Carbon::parse($row->date)->format('d/m/Y'),
            ];
        });

        $lilaData = $monitorings->map(function ($row) use ($maxLila) {
            return [
                'week' => $row->usia_kehamilan . 'w',
                'value' => $row->lila,
                'percentage' => ($row->lila / $maxLila) * 100,
                'date' => \Carbon\Carbon::parse($row->date)->format('d/m/Y'),
            ];
        });

        $hbData = $monitorings->map(function ($row) use ($maxHb) {
            return [
                'week' => $row->usia_kehamilan . 'w',
                'value' => $row->hb,
                'percentage' => ($row->hb / $maxHb) * 100,
                'date' => \Carbon\Carbon::parse($row->tanggal)->format('d/m/Y'),
            ];
        });


        return view('ibu_hamil.monitoring', compact(
            'user',
            'monitorings',
            'latest',
            'status',
            'badgeColor',
            'weightData',
            'lilaData',
            'hbData'
        ));
    }


    // Tambah data baru
    public function store(Request $request)
    {
        $data = $request->validate([
            'tanggal' => 'required|date',
            'usia_kehamilan' => 'required|integer',
            'lila' => 'required|numeric',
            'berat_badan' => 'required|numeric',
            'tinggi_badan' => 'nullable|numeric',
            'tekanan_darah_sistolik' => 'nullable|integer',
            'tekanan_darah_diastolik' => 'nullable|integer',
            'nadi' => 'nullable|integer',
            'respirasi' => 'nullable|integer',
            'paritas' => 'nullable|string',
            'hb' => 'required|numeric',
            'konsumsi_mrj' => 'boolean',
            'konsumsi_penambah_darah' => 'boolean',
        ]);

        $data['ibu_hamil_id'] = Auth::id();
        $data['pengelola_id'] = Auth::id(); // bisa disesuaikan jika ada pengelola khusus

        Monitoring::create($data);

        return redirect()->back()->with('success', 'Data monitoring berhasil ditambahkan');
    }

    // Form edit data
    public function edit(Monitoring $monitoring)
    {
        // Pastikan hanya owner yang bisa edit
        if ($monitoring->ibu_hamil_id !== Auth::id()) {
            abort(403);
        }

        return view('ibu_hamil.monitoring_edit', compact('monitoring'));
    }

    // Update data
    public function update(Request $request, Monitoring $monitoring)
    {
        if ($monitoring->ibu_hamil_id !== Auth::id()) {
            abort(403);
        }

        $data = $request->validate([
            'tanggal' => 'required|date',
            'usia_kehamilan' => 'required|integer',
            'lila' => 'required|numeric',
            'berat_badan' => 'required|numeric',
            'tinggi_badan' => 'nullable|numeric',
            'tekanan_darah_sistolik' => 'nullable|integer',
            'tekanan_darah_diastolik' => 'nullable|integer',
            'nadi' => 'nullable|integer',
            'respirasi' => 'nullable|integer',
            'paritas' => 'nullable|string',
            'hb' => 'required|numeric',
            'konsumsi_mrj' => 'boolean',
            'konsumsi_penambah_darah' => 'boolean',
        ]);

        $monitoring->update($data);

        return redirect()->route('ibu_hamil.dashboard')->with('success', 'Data monitoring berhasil diperbarui');
    }

    // Hapus data
    public function destroy(Monitoring $monitoring)
    {
        if ($monitoring->ibu_hamil_id !== Auth::id()) {
            abort(403);
        }

        $monitoring->delete();

        return redirect()->route('ibu_hamil.dashboard')->with('success', 'Data monitoring berhasil dihapus');
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

    public function storeMRJ(Request $request)
    {
        $request->validate([
            'mrj_tracker_id'   => 'required|exists:mrj_trackers,id',
            'tanggal'          => 'required|date',
            'konsumsi_harian'  => 'required|integer|min:1|max:2',
        ]);

        $ibuId = Auth::id();

        // ambil stok kader
        $mrj = MrjTracker::findOrFail($request->mrj_tracker_id);

        if ($mrj->stok_sisa < $request->konsumsi_harian) {
            return redirect()->back()->with('error', 'Stok MRJ dari kader tidak mencukupi.');
        }

        // cek apakah ibu sudah punya catatan konsumsi untuk tanggal ini
        $existing = IbuHamilMrjTracker::where('ibu_hamil_id', $ibuId)
            ->whereDate('tanggal', $request->tanggal)
            ->first();

        if ($existing) {
            // kalau sudah ada → update konsumsi_harian
            $existing->update([
                'konsumsi_harian' => $existing->konsumsi_harian + $request->konsumsi_harian,
                'stok_sisa'       => $mrj->stok_sisa - $request->konsumsi_harian,
            ]);
        } else {
            // kalau belum ada → buat baru dengan target_harian sama seperti stok kader atau default
            IbuHamilMrjTracker::create([
                'ibu_hamil_id'     => $ibuId,
                'mrj_tracker_id'   => $mrj->id,
                'tanggal'          => $request->tanggal,
                'target_harian'    => 2, // default target, bisa juga ambil dari user setting
                'konsumsi_harian'  => $request->konsumsi_harian,
                'stok_sisa'        => $mrj->stok_sisa - $request->konsumsi_harian,
            ]);
        }

        // update stok kader
        $mrj->decrement('stok_sisa', $request->konsumsi_harian);

        return redirect()->back()->with('success', 'Konsumsi MRJ berhasil dicatat.');
    }
}
