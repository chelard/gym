<?php

namespace App\Models;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $guarded = [];

    protected $casts = [
        'date_of_birth' => 'date',
        'registration_date' => 'date',
    ];

    public static function getForm()
    {
        return [
            Section::make('Datos')
            ->columns(2)
            ->schema(
                [
                    TextInput::make('dni')
                        ->label(__('DNI'))
                        ->required()
                        ->numeric()
                        ->maxLength(255),
                    TextInput::make('name')
                        ->label(__('Nombres'))
                        ->required()
                        ->maxLength(255),
                    TextInput::make('email')
                        ->label(__('Correo Electrónico'))
                        ->email()
                        ->required()
                        ->maxLength(255),
                    TextInput::make('phone')
                        ->label(__('Teléfono'))
                        ->tel()
                        ->maxLength(255),
                ]
            ),

            Section::make('Detalles')
            ->columns(2)
            ->schema(
                [
                    TextInput::make('address')
                        ->label(__('Dirección'))
                        ->maxLength(255),
                    DatePicker::make('date_of_birth')
                        ->label(__('Fecha de Nacimiento'))
                        ->required(),
                    DatePicker::make('registration_date')
                        ->label(__('Fecha de Registro'))
                        ->default(now())
                        ->required(),
                    TextInput::make('emergency_contact_name')
                        ->label(__('Contacto de Emergencia'))
                        ->maxLength(255),
                    TextInput::make('emergency_contact_phone')
                        ->label(__('Teléfono de Emergencia'))
                        ->tel()
                        ->maxLength(255),
                    Textarea::make('medical_notes')
                        ->label(__('Notas Médicas'))
                        ->columnSpanFull(),
                    Textarea::make('photo')
                        ->label(__('Foto'))
                        ->columnSpanFull(),
                ]
            ),


        ];
    }


}
