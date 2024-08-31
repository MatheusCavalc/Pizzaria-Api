<?php

namespace App\Filament\Resources\HalfResource\Pages;

use App\Filament\Resources\HalfResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewHalf extends ViewRecord
{
    protected static string $resource = HalfResource::class;

    protected ?string $heading = 'Visualizar Sabor/Meia Pizza';

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make()->label('Editar'),
        ];
    }
}
