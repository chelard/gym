<?php

namespace App\Models;

use App\Http\Controllers\ClientController;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Set;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
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
                        ->required()
                        ->label('DNI')
                        ->length(8)
                        ->numeric()
                        ->suffixAction(
                            Action::make('getDni')
                                ->icon('heroicon-m-clipboard')

                                ->action(function (Set $set, callable $get) {
                                    $dni = $get('dni');
                                    if (preg_match('/^\d{8}$/', $dni)) {
                                        $controller = new ClientController();
                                        $nombreCompleto = $controller->getDni($dni);
                                        $set('name', $nombreCompleto);
                                    } else {
                                        // Manejar el error de validación
                                        Notification::make()
                                            ->title('Error: DNI inválido')
                                            ->icon('heroicon-o-exclamation-circle')
                                            ->send();
                                    }



                                })
                        ),
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
