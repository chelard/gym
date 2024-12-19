<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SuscriptionResource\Pages;
use App\Filament\Resources\SuscriptionResource\RelationManagers;
use App\Models\Suscription;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SuscriptionResource extends Resource
{
    protected static ?string $model = Suscription::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema(
                Suscription::getForm(),
            );
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('client.name')
                    ->label(__('Cliente'))
                    ->searchable()
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('plan.name')
                    ->label(__('Tipo de Plan'))
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('start_date')
                    ->label(__('Fecha de Inicio'))
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('end_date')
                    ->label(__('Fecha de Fin'))
                    ->date()
                    ->sortable(),

                Tables\Columns\TextColumn::make('status')
                    ->label(__('Estado'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('frozen_days')
                    ->label(__('Días congelados'))
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('remaining_days')
                    ->label(__('Días restantes'))
                    ->numeric()
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
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }



    public static function getRelations(): array
    {
        return [
            RelationManagers\PaymentsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSuscriptions::route('/'),
            'create' => Pages\CreateSuscription::route('/create'),
            'edit' => Pages\EditSuscription::route('/{record}/edit'),
        ];
    }

    public static function getLabel(): ?string
    {
        return __('Suscripción');
    }

    public static function getPluralLabel(): ?string
    {
        return __('Suscripciones');

    }
}
