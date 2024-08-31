<?php

namespace App\Filament\Resources\HalfResource\Pages;

use App\Filament\Resources\HalfResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditHalf extends EditRecord
{
    protected static string $resource = HalfResource::class;

    protected ?string $heading = 'Editar Sabor/Meia Pizza';

    protected function getSavedNotificationTitle(): ?string
    {
        return 'Sabor/Meia Pizza atualizado';
    }

    protected function getFormActions(): array
    {
        return [
            $this->getSaveFormAction()->label('Salvar alterações'),
            $this->getCancelFormAction()->label('Cancelar'),
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make()->label('Visualizar'),
            Actions\DeleteAction::make()->label('Excluir')
                ->modalHeading('Excluir sabor/meia pizza')
                ->modalDescription('Tem certeza de que deseja excluir este sabor/meia pizza? Isto não pode ser desfeito.')
                ->modalSubmitActionLabel('Sim, excluir')
                ->modalCancelActionLabel('Cancelar')
                ->successNotificationTitle('Sabor/Meia Pizza excluído'),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
