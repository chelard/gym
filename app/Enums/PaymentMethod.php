<?php

namespace App\Enums;

enum PaymentMethod: string
{
    case Efectivo = 'Efectivo';
    case TarjetaDebito = 'Tarjeta de débito';
    case TarjetaCredito = 'Tarjeta de crédito';
    case Transferencia = 'Transferencia';
    case yape = 'Yape';
    case plin = 'Plin';

    public function getLabel():?string
    {
        return match ($this) {
            self::Efectivo => 'Efectivo',
            self::TarjetaDebito => 'Tarjeta de débito',
            self::TarjetaCredito => 'Tarjeta de crédito',
            self::Transferencia => 'Transferencia',
            self::yape => 'Yape',
            self::plin => 'Plin',
        };
    }

    public static function getLabels():array
    {
        return [
            self::Efectivo->value => self::Efectivo->getLabel(),
            self::TarjetaDebito->value => self::TarjetaDebito->getLabel(),
            self::TarjetaCredito->value => self::TarjetaCredito->getLabel(),
            self::Transferencia->value => self::Transferencia->getLabel(),
            self::yape->value => self::yape->getLabel(),
            self::plin->value => self::plin->getLabel(),
        ];
    }


}
