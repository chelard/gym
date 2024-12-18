<?php

namespace App\Enums;

enum PaymentStatus: string
{
        case Pendiente = 'Pendiente';
        case Pagado = 'Pagado';
        case Cancelado = 'Cancelado';

        public function getLabel(): ?string
        {
            return match ($this) {
                self::Pendiente => 'Pendiente',
                self::Pagado => 'Pagado',
                self::Cancelado => 'Cancelado',
            };
        }

        public static function getLabels(): array
        {
            return [
                self::Pendiente->value => self::Pendiente->getLabel(),
                self::Pagado->value => self::Pagado->getLabel(),
                self::Cancelado->value => self::Cancelado->getLabel(),
            ];
        }


}
