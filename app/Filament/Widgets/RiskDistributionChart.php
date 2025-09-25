<?php

namespace App\Filament\Widgets;

use App\Models\Monitoring;
use Filament\Widgets\ChartWidget;

class RiskDistributionChart extends ChartWidget
{
    protected static ?string $heading = 'Distribusi Ibu Hamil (Normal vs Risiko)';

     protected int|string|array $columnSpan = '1/2';


    protected function getData(): array
    {
         // Hitung jumlah risiko
        $risiko = Monitoring::where(function ($q) {
            $q->where('tinggi_badan', '<', 145)
              ->orWhere('hb', '<', 11)
              ->orWhere('tekanan_darah_sistolik', '>=', 140)
              ->orWhere('tekanan_darah_diastolik', '>=', 90)           
              ->orWhere('paritas', '>=', 4);
        })->count();

        // Hitung jumlah normal (total - risiko)
        $total = Monitoring::count();
        $normal = $total - $risiko;

        return [
            'datasets' => [
                [
                    'data' => [$normal, $risiko],
                    'backgroundColor' => ['#36A2EB', '#FF6384'], // biru = normal, merah = risiko
                ],
            ],
            'labels' => ['Normal', 'Risiko'],
        ];
    }

    protected function getType(): string
    {
        return 'pie';
    }

    protected function getOptions(): array
    {
        return [
            'responsive' => true,
            'maintainAspectRatio' => true,
            'aspectRatio' => 1.5, // Sama dengan bar chart
            'plugins' => [
                'legend' => [
                    'display' => true,
                    'position' => 'top',
                ],
            ],
        ];
    }
}
