<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HalfResource\Pages;
use App\Filament\Resources\HalfResource\RelationManagers;
use App\Models\Half;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Notifications\Notification;
use Filament\Tables\Enums\ActionsPosition;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class HalfResource extends Resource
{
    protected static ?string $model = Half::class;

    protected static ?string $modelLabel = 'Meia Pizzas';

    protected static ?int $navigationSort = 4;

    protected static ?string $navigationGroup = 'Gestão de Loja';

    protected static ?string $navigationIcon = 'heroicon-o-chart-pie';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Nome')
                    ->required(),
                //Forms\Components\FileUpload::make('image')
                //    ->image(),
                Forms\Components\TextInput::make('link_image')
                    ->label('Link da Imagem'),
                Forms\Components\Toggle::make('on_sell')
                    ->label('À Venda')
                    ->required(),
                Forms\Components\Textarea::make('description')
                    ->label('Descrição')
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('price')
                    ->label('Preço')
                    ->required()
                    ->prefix('R$'),
                Forms\Components\TextInput::make('quantity')
                    ->label('Quantidade')
                    ->required()
                    ->numeric()
                    ->default(0),
                Forms\Components\Toggle::make('on_sale')
                    ->label('Em Promoção')
                    ->required(),
                Forms\Components\TextInput::make('sale_price')
                    ->label('Preço em Promoção')
                    ->prefix('R$'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nome')
                    ->searchable(),
                //Tables\Columns\ImageColumn::make('image'),
                Tables\Columns\ImageColumn::make('link_image')
                    ->label('Link da Imagem'),
                Tables\Columns\ToggleColumn::make('on_sell')
                    ->label('À Venda'),
                Tables\Columns\TextColumn::make('price')
                    ->label('Preço')
                    ->money('brl')
                    ->sortable(),
                Tables\Columns\ToggleColumn::make('on_sale')
                    ->label('Em Promoção'),
                Tables\Columns\TextColumn::make('quantity')
                    ->label('Quantidade')
                    ->numeric(),
                Tables\Columns\TextColumn::make('sale_price')
                    ->label('Preço em Promoção')
                    ->money('brl')
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->searchPlaceholder('Procurar Sabor')
            ->filters([
                Tables\Filters\TernaryFilter::make('on_sale')
                    ->label('Em Promoção')
                    //->placeholder('Todos os Produtos')
                    ->trueLabel('Sabores em Promoção')
                    ->falseLabel('Sabores com Preço Padrão')
                    ->indicator('Filtro'),
                Tables\Filters\TernaryFilter::make('on_sell')
                    ->label('À Venda')
                    //->placeholder('Sabores à Venda')
                    ->trueLabel('Sabores à Venda')
                    ->falseLabel('Sabores que não estão à Venda')
                    ->indicator('Filtro'),
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->label('Visualizar'),
                Tables\Actions\EditAction::make()
                    ->label('Editar'),
                Tables\Actions\DeleteAction::make()
                    ->label('Excluir')
                    ->modalHeading('Excluir produto')
                    ->modalDescription('Tem certeza de que deseja excluir este produto? Isto não pode ser desfeito.')
                    ->modalSubmitActionLabel('Sim, excluir')
                    ->modalCancelActionLabel('Cancelar')
                    ->successNotification(
                        Notification::make()
                            ->success()
                            ->title('Produto excluído')
                            ->body('O produto foi excluído com sucesso'),
                    ),
            ], position: ActionsPosition::BeforeCells)
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListHalves::route('/'),
            'create' => Pages\CreateHalf::route('/create'),
            'view' => Pages\ViewHalf::route('/{record}'),
            'edit' => Pages\EditHalf::route('/{record}/edit'),
        ];
    }
}
