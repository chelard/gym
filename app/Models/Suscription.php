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
                    ->required()
                    ->reactive()
                    ->live()
                    ->afterStateUpdated(function ($state, callable $set, callable $get) {
                        $plan = \App\Models\Plan::find($state);

                        $start_date = \Carbon\Carbon::parse($get('start_date'));
                        $end_date = $start_date?->copy()->addDays($plan ? $plan->days_duration : 0);
                        ray($end_date);
                        $set('end_date', now());
                        $set('price_paid', $plan ? $plan->price : null);

                        $set('frozen_days', $plan ? $plan->freeze_days : 0);
                        $set('remaining_days', $plan ? $plan->days_duration : 0);
                    }),

                DatePicker::make('start_date')
                    ->label(__('Fecha de Inicio'))
                    ->default(now())
                    ->required(),
                DatePicker::make('end_date')
                    ->format('d/m/Y')
                    ->label(__('Fecha de Fin'))
                    ->required(),
                TextInput::make('price_paid')
                    ->label(__('Precio Pagado'))
                    ->required()
                    ->numeric(),
               Select::make('status')
                    ->label(__('Estado'))
                    ->options(SubscriptionStatus::getLabels())
                    ->default(SubscriptionStatus::Activa)
                    ->required(),
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
