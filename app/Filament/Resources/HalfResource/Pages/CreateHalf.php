<?php

namespace App\Filament\Resources\HalfResource\Pages;

use App\Filament\Resources\HalfResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateHalf extends CreateRecord
{
    protected static string $resource = HalfResource::class;

    protected ?string $heading = 'Criar Sabor/Meia Pizza';

    protected function getCreatedNotificationTitle(): ?string
    {
        return 'Sabor/Meia Pizza criada';
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
