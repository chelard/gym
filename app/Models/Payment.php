<?php

namespace App\Models;

use App\Enums\PaymentMethod;
use App\Enums\PaymentStatus;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    /** @use HasFactory<\Database\Factories\PaymentFactory> */
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'payment_date' => 'date',
        'amount' => 'decimal:2',
        'payment_method' => PaymentMethod::class,
        'status' => PaymentStatus::class,

    ];

    public static function getForm(): array
    {
        return(
        [

            TextInput::make('payment_date')
                ->required()
                ->maxLength(255),
            TextInput::make('amount')
                ->required()
                ->numeric(),
            TextInput::make('payment_method')
                ->required()
                ->maxLength(255)
                ->default('Efectivo'),
            TextInput::make('reference_transaction')
                ->maxLength(255),
            TextInput::make('status')
                ->required()
                ->maxLength(255)
                ->default('Pendiente'),
            TextInput::make('installment_number')
                ->required()
                ->numeric()
                ->default(1),
            TextInput::make('total_installments')
                ->required()
                ->numeric()
                ->default(1),

            Textarea::make('notes')
                ->columnSpanFull(),
        ]
        );
    }

    public function suscription(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Suscription::class);
    }
}
