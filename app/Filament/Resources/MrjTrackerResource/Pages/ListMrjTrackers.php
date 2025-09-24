<?php

namespace App\Filament\Resources\MrjTrackerResource\Pages;

use App\Filament\Resources\MrjTrackerResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMrjTrackers extends ListRecords
{
    protected static string $resource = MrjTrackerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
