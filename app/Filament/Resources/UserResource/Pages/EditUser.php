<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    protected $identitasData = [];

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        // Load data identitas ke form saat edit
        if ($this->record->identitas) {
            $data['identitas'] = [
                'nik' => $this->record->identitas->nik,
                'nomor_telepon' => $this->record->identitas->nomor_telepon,
                'alamat' => $this->record->identitas->alamat,
                'tanggal_lahir' => $this->record->identitas->tanggal_lahir,
            ];
        }
        
        return $data;
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        // Pisahkan data identitas sebelum save user
        if (isset($data['identitas'])) {
            $this->identitasData = $data['identitas'];
            unset($data['identitas']);
        }
        
        return $data;
    }

    protected function afterSave(): void
    {
        // Update atau create identitas setelah user disave
        if (!empty($this->identitasData)) {
            $this->record->identitas()->updateOrCreate(
                ['user_id' => $this->record->id],
                $this->identitasData
            );
        }
    }
}
