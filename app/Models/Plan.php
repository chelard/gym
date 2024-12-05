<?php

namespace App\Models;

use App\Enums\PlanType;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    /** @use HasFactory<\Database\Factories\PlanFactory> */
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'registration_deadline' => 'date',
        'type' => PlanType::class,
        'price' => 'decimal:2',
        'days_duration' => 'integer',
        'freeze_days' => 'integer',
    ];

    public static function getForm(): array
    {
        return [

            Section::make('Información del Plan')
            ->columns(2)
                ->description('Ingrese los datos de la plan para la subscripción.')
            ->schema(
                [
                    TextInput::make('name')
                        ->label(__('Nombre'))
                        ->required()
                        ->maxLength(255),
                    Select::make('type')
                        ->label(__('Tipo'))
                        ->required()
                        ->options(PlanType::getLabels())
                        ->default(PlanType::Tiempo)
                        ->placeholder(__('Seleccione un tipo')),
                    TextInput::make('days_duration')
                        ->label(__('Duración en días'))
                        ->required()
                        ->numeric()
                        ->default(0),
                    TextInput::make('price')
                        ->label(__('Precio'))
                        ->required()
                        ->numeric()
                        ->prefix('S/ '),
                    TextInput::make('freeze_days')
                        ->label(__('Días max. permitidos de congelamiento'))
                        ->numeric()
                        ->default(0),

                    DatePicker::make('registration_deadline')
                        ->default(now()->addDays(30))
                        ->label(__('Fecha límite de inscripción')),
                ]
            ),


        ];



    }


}
