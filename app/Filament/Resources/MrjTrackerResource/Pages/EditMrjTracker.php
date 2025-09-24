<?php

namespace App\Filament\Resources\MrjTrackerResource\Pages;

use App\Filament\Resources\MrjTrackerResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMrjTracker extends EditRecord
{
    protected static string $resource = MrjTrackerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
