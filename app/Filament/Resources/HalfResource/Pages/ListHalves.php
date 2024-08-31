<?php

namespace App\Filament\Resources\HalfResource\Pages;

use App\Filament\Resources\HalfResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListHalves extends ListRecords
{
    protected static string $resource = HalfResource::class;

    protected ?string $heading = 'Sabores/Meia Pizzas';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Criar Sabor/Meia Pizzas'),
        ];
    }
}
