<?php

namespace App\Filament\Widgets;

use App\Models\Monitoring;
use Filament\Widgets\ChartWidget;

class MonitoringPerMonthChart extends ChartWidget
{
    protected static ?string $heading = 'Jumlah Pemeriksaan per Bulan';
    protected int|string|array $columnSpan = '1/2';



    protected function getData(): array
    {
        // Ambil data 6 bulan terakhir
        $rows = Monitoring::selectRaw("DATE_FORMAT(tanggal, '%Y-%m') as ym, COUNT(*) as total")
            ->groupBy('ym')
            ->orderBy('ym', 'desc')
            ->limit(6)
            ->get()
            ->reverse(); // biar urut dari lama ke terbaru

        return [
            'datasets' => [
                [
                    'label' => 'Pemeriksaan',
                    'data' => $rows->pluck('total')->toArray(),
                ],
            ],
            'labels' => $rows->pluck('ym')->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
    
    protected function getOptions(): array
    {
        return [
            'responsive' => true,
            'maintainAspectRatio' => true,
            'aspectRatio' => 1.5, // Sama dengan pie chart
            'plugins' => [
                'legend' => [
                    'display' => true,
                    'position' => 'top',
                ],
            ],
            'scales' => [
                'y' => [
                    'beginAtZero' => true,
                ],
            ],
        ];
    }
}
