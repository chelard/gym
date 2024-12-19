<?php

namespace App\Filament\Resources\SuscriptionResource\RelationManagers;

use App\Models\Payment;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PaymentsRelationManager extends RelationManager
{
    protected static string $relationship = 'payments';



    public function form(Form $form): Form
    {
        return $form
            ->schema(
                Payment::getForm(),
            );
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('amount')
            ->columns([
                Tables\Columns\TextColumn::make('amount')
                    ->label('Monto Pagado'),
                Tables\Columns\TextColumn::make('payment_date')
                    ->label('Fecha de Pago'),

                Tables\Columns\TextColumn::make('payment_method')
                    ->label('Método de Pago'),
                Tables\Columns\TextColumn::make('reference_transaction')
                    ->label('Ref. de Transacción'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public function isReadOnly(): bool
    {
        return true;
    }


}
