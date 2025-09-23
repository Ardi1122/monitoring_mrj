<?php

namespace App\Filament\Resources\LogBookResource\Widgets;

use Filament\Widgets\ChartWidget;

class LogbookStats extends ChartWidget
{
    protected static ?string $heading = 'Chart';

    protected function getData(): array
    {
        return [
            //
        ];
    }

    protected function getType(): string
    {
        return 'pie';
    }
}
