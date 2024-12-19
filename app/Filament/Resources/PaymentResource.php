<?php

namespace App\Filament\Resources;

use App\Enums\PaymentMethod;
use App\Enums\PaymentStatus;
use App\Enums\SubscriptionStatus;
use App\Filament\Resources\PaymentResource\Pages;
use App\Filament\Resources\PaymentResource\RelationManagers;
use App\Models\Payment;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PaymentResource extends Resource
{
    protected static ?string $model = Payment::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema(
                Payment::getForm(),
            );
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('suscription.client.name')
                    ->label(__('Cliente'))
                    ->searchable()
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('payment_date')
                    ->label(__('Fecha de Pago'))
                    ->dateTime('d/m/Y')
                    ->searchable(),
                Tables\Columns\TextColumn::make('amount')
                    ->label(__('Monto Pagado'))
                    ->numeric()
                    ->summarize(
                        Tables\Columns\Summarizers\Sum::make(),
                    )
                    ->sortable(),
                Tables\Columns\TextColumn::make('payment_method')
                    ->label(__('Método de Pago'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('reference_transaction')
                    ->label(__('Ref. de Transacción'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->label(__('Estado'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('installment_number')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('total_installments')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
                Filter::make('payment_date')
                    ->form([
                        DatePicker::make('payment_date_from')
                            ->label(__('Desde')),
                        DatePicker::make('payment_date_until')
                            ->label(__('Hasta')),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['payment_date_from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('payment_date', '>=', $date),
                            )
                            ->when(
                                $data['payment_date_until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('payment_date', '<=', $date),
                            );
                    }),
                SelectFilter::make('payment_method')
                    ->label(__('Método de Pago'))
                    ->options(PaymentMethod::getLabels()),
                SelectFilter::make('status')
                    ->label(__('Estado'))
                    ->options(PaymentStatus::getLabels()),
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPayments::route('/'),
            'create' => Pages\CreatePayment::route('/create'),
            'edit' => Pages\EditPayment::route('/{record}/edit'),
        ];
    }

    public static function getModelLabel(): string
    {
        return __('Pago');
    }
}
