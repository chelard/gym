<?php

namespace App\Models;

use App\Enums\SubscriptionStatus;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Suscription extends Model
{
    /** @use HasFactory<\Database\Factories\SuscriptionFactory> */
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'last_access_date' => 'date',
        'price_paid' => 'decimal:2',
        'status' => SubscriptionStatus::class,

    ];

    public static function getForm(): array
    {
        return[

                Select::make('client_id')
                    ->label(__('Cliente'))
                    ->relationship('client', 'name')
                    ->searchable()
                    ->required(),
                Select::make('plan_id')
                    ->label(__('Tipo de Plan'))
                    ->relationship('plan', 'name')
                    ->default(1)
                    ->required(),

                DatePicker::make('start_date')
                    ->label(__('Fecha de Inicio'))
                    ->default(now())
                    ->required(),
                DatePicker::make('end_date')
                    ->label(__('Fecha de Fin'))
                    ->default(now())
                    ->required(),
                TextInput::make('price_paid')
                    ->label(__('Precio Pagado'))
                    ->required()
                    ->numeric(),
                TextInput::make('status')
                    ->label(__('Estado'))
                    ->required()
                    ->maxLength(255)
                    ->default(SubscriptionStatus::Activa),
                TextInput::make('frozen_days')
                    ->label(__('Días Congelados'))
                    ->required()
                    ->numeric()
                    ->default(0),
                DatePicker::make('last_access_date')
                    ->label(__('Último Acceso'))
                    ->default(now())
                    ->required(),
                TextInput::make('remaining_days')
                    ->label(__('Días Restantes'))
                    ->numeric(),
                Textarea::make('notes')
                    ->label(__('Notas'))
                    ->columnSpanFull(),

        ];

    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function plan(): BelongsTo
    {
        return $this->belongsTo(Plan::class);
    }
}
