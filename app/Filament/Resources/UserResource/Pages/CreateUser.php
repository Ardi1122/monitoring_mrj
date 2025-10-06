<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;

    protected $identitasData = [];

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Pisahkan data identitas dari data user
        if (isset($data['identitas'])) {
            $this->identitasData = $data['identitas'];
            unset($data['identitas']);
        }
        
        return $data;
    }

    protected function afterCreate(): void
    {
        // Buat identitas setelah user berhasil dibuat
        if (!empty($this->identitasData)) {
            $this->record->identitas()->create($this->identitasData);
        }
    }
}
