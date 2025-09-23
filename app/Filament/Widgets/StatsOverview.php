<?php

namespace App\Filament\Widgets;

use App\Models\User;
use App\Models\Monitoring;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            // Total Ibu Hamil - Hijau
            Stat::make('Total Ibu Hamil', User::where('role', 'ibu_hamil')->count())
                ->color('success')
                ->icon('heroicon-o-user-group')
                ->extraAttributes([
                    'class' => 'bg-green-100 border-l-4 border-green-500',
                    'style' => 'background-color: #dcfce7 !important; border-radius: 8px;'
                ]),

            // Pemeriksaan Bulan Ini - Biru
            Stat::make('Pemeriksaan Bulan Ini', Monitoring::whereBetween('tanggal', [
                now()->startOfMonth(),
                now()->endOfMonth()
            ])->count())
                ->color('info')
                ->icon('heroicon-o-clipboard-document')
                ->extraAttributes([
                    'class' => 'bg-blue-100 border-l-4 border-blue-500',
                    'style' => 'background-color: #dbeafe !important; border-radius: 8px;'
                ]),

            // Kasus Risiko - Merah
            Stat::make('Kasus Risiko', Monitoring::where(function ($query) {
                $query->where('tinggi_badan', '<', 145)
                      ->orWhere('hb', '<', 11)
                      ->orWhere('tekanan_darah', '>=', 140)
                      ->orWhere('tekanan_darah', '>=', 90);
            })->count())
                ->color('danger')
                ->icon('heroicon-o-exclamation-triangle')
                ->extraAttributes([
                    'class' => 'bg-red-100 border-l-4 border-red-500',
                    'style' => 'background-color: #fee2e2 !important; border-radius: 8px;'
                ]),
        ];
    }
}