<?php

namespace App\Models;

use App\Enums\PaymentMethod;
use App\Enums\SubscriptionStatus;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Wizard;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\HtmlString;

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
            Wizard::make([
                Wizard\Step::make('Cliente')
                    ->columnSpan('full')
                    ->description('Datos del Cliente')
                    ->schema(
                        self::getSuscriptionForm()
                    ),
                Wizard\Step::make('Pagos')
                    ->description('Datos de los Pagos')
                    ->schema(
                        self::getPaymentForm()
                    ),

            ])
                ->columnSpan('full')
                ->columns(2)
                ->submitAction(new HtmlString(Blade::render(<<<BLADE
                    <x-filament::button
                        type="submit"
                        size="sm"
                    >
                        Submit
                    </x-filament::button>
                BLADE))),






        ];

    }

    /**
     * @return array
     */
    public static function getSuscriptionForm(): array
    {
        return [
            Select::make('client_id')
                ->label(__('Cliente'))
                ->relationship('client', 'name')
                ->searchable()
                ->required()
                ->createOptionForm(
                    Client::getSimpleForm(),
                ),
            Select::make('plan_id')
                ->label(__('Tipo de Plan'))
                ->relationship('plan', 'name')
                ->required()
                ->reactive()
                ->live()
                ->afterStateUpdated(function ($state, callable $set, callable $get) {
                    $plan = \App\Models\Plan::find($state);

                    $start_date = \Carbon\Carbon::parse($get('start_date'));
                    $end_date = $start_date->copy()->addDays($plan->days_duration);
                    $formatted_end_date = $end_date->format('d/m/Y');
                    $set('end_date', $formatted_end_date);
                    ray($formatted_end_date);
                    $set('end_date', $formatted_end_date);
                    $set('price_paid', $plan ? $plan->price : null);
                    $set('amount', $plan ? $plan->price : null);
                    $set('frozen_days', $plan ? $plan->freeze_days : 0);
                    $set('remaining_days', $plan ? $plan->days_duration : 0);

                }),
            DatePicker::make('start_date')
                ->label(__('Fecha de Inicio'))
                ->default(now())
                ->required(),
            TextInput::make('end_date')
                ->readOnly(true)
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

    /**
     * @return array
     */
    public static function getPaymentForm(): array
    {
        return [
            DatePicker::make('payment_date')
                ->label(__('Fecha de Pago'))
                ->readOnly(true)
                ->required()
                ->default(now()),
            TextInput::make('amount')
                ->label(__('Monto Pagado'))
                ->required()
                ->numeric(),
            Select::make('payment_method')
                ->required()
                ->label(__('Método de Pago'))
                ->options(PaymentMethod::getLabels())
                ->default(PaymentMethod::Efectivo),
            TextInput::make('reference_transaction')
                ->label(__('Referencia de Transacción')),
            Select::make('status')
                ->label(__('Estado'))
                ->options(SubscriptionStatus::getLabels())
                ->default(SubscriptionStatus::Activa)
                ->required(),


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

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);

    }
}
