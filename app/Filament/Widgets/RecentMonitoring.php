<?php

namespace App\Filament\Widgets;

use App\Models\Monitoring;
use Filament\Widgets\TableWidget as BaseWidget;
use Filament\Tables\Columns\TextColumn;
// BadgeColumn sudah deprecated, hapus import ini

class RecentMonitoring extends BaseWidget
{
    protected static ?string $heading = 'Pemeriksaan Terbaru';
    protected int | string | array $columnSpan = 'full';

    // PERBAIKAN 1: Hilangkan limit, tambah with untuk relasi
    protected function getTableQuery(): \Illuminate\Database\Eloquent\Builder
    {
        return Monitoring::query()
            ->with(['ibuHamil'])
            ->latest('tanggal');
    }

    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('ibuHamil.name')
                ->label('Nama Ibu'),

            TextColumn::make('tanggal')
                ->date('d/m/Y')
                ->label('Tanggal'),
                

            TextColumn::make('tinggi_badan')
                ->label('Tinggi Badan (cm)'),

            TextColumn::make('hb')
                ->label('Hb'),

            TextColumn::make('tekanan_darah')
                ->label('Tekanan Darah'),

            // PERBAIKAN 2: Gunakan TextColumn dengan badge
            TextColumn::make('risk')
                ->label('Risiko')
                ->getStateUsing(function (Monitoring $record) {
                    // Perbaikan parsing tekanan_darah yang lebih aman
                    $sistolik = 0;
                    $diastolik = 0;
                    
                    if ($record->tekanan_darah) {
                        $parts = explode('/', $record->tekanan_darah);
                        if (count($parts) >= 2) {
                            $sistolik = (int) trim($parts[0]);
                            $diastolik = (int) trim($parts[1]);
                        }
                    }

                    if ($record->tinggi_badan < 145 || $record->hb < 11 || $sistolik >= 140 || $diastolik >= 90) {
                        return 'Tinggi';
                    }

                    if ($record->tinggi_badan < 150 || $record->hb < 12 || $sistolik >= 130 || $diastolik >= 85) {
                        return 'Sedang';
                    }

                    return 'Rendah';
                })
                ->badge()
                ->color(fn (string $state): string => match ($state) {
                    'Tinggi' => 'danger',
                    'Sedang' => 'warning',
                    'Rendah' => 'success',
                    default => 'primary',
                }),
        ];
    }

    // PERBAIKAN 3: Tambahkan pagination
    protected function isTablePaginationEnabled(): bool
    {
        return true;
    }

    // PERBAIKAN 3: Method harus public dan sesuai signature
    public function getDefaultTableRecordsPerPageSelectOption(): int
    {
        return 10;
    }
}