<?php

namespace App\Filament\Pages;

use Filament\Pages\Dashboard as BaseDashboard;

class Dashboard extends BaseDashboard
{
    protected static ?string $navigationIcon = 'heroicon-o-home';

    public function getWidgets(): array
    {
        return [
            \App\Filament\Widgets\StatsOverview::class,
            \App\Filament\Widgets\MonitoringPerMonthChart::class,
            \App\Filament\Widgets\RiskDistributionChart::class,
            \App\Filament\Widgets\RecentMonitoring::class,
        ];

    }

    public function getHeaderActions(): array
    {
        return [];
    }
    
    // Override untuk menambahkan custom styles
    protected function getViewData(): array
    {
        return array_merge(parent::getViewData(), [
            'customStyles' => true,
        ]);
    }
    
}
