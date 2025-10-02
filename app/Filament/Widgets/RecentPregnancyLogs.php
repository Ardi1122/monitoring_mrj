<?php

namespace App\Filament\Widgets;

use Filament\Tables;
use Filament\Tables\Table;
use App\Models\PregnancyLog;
use Filament\Tables\Columns\TextColumn;
use Filament\Widgets\TableWidget as BaseWidget;

class RecentPregnancyLogs extends BaseWidget
{
    protected function getTableQuery(): \Illuminate\Database\Eloquent\Builder

    
    {
        return PregnancyLog::query()
            ->with(['ibuHamil']) // pastikan relasi user() ada di model PregnancyLog
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

            TextColumn::make('mood')
                ->label('Mood'),

            TextColumn::make('symptoms')
                ->label('Gejala')
                ->formatStateUsing(function ($state) {
                    // pastikan $state selalu array
                    if (is_string($state)) {
                        $decoded = json_decode($state, true);
                        if (json_last_error() === JSON_ERROR_NONE) {
                            $state = $decoded;
                        } else {
                            return $state; 
                        }
                    }

                    if (is_array($state)) {
                        return implode(', ', $state);
                    }

                    return '-';
                })
                ->wrap(),

            TextColumn::make('appetite')
                ->label('Nafsu Makan'),

            TextColumn::make('notes')
                ->label('Catatan')
                ->wrap(), // supaya text panjang bisa dibungkus
        ];
    }

    
}
