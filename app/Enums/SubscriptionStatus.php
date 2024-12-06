<?php

namespace App\Enums;

enum SubscriptionStatus: string
{
    case Activa = 'Activa';
    case PruebaGratuita = 'Prueba gratuita';
    case Programada = 'Programada';
    case Pausada = 'Pausada';
    case ActivaConPausa = 'Activa*';
    case CancelacionSolicitada = 'Cancelación solicitada';
    case Impagado = 'Impagado';
    case Cancelada = 'Cancelada';
    case Vencida = 'Vencida';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::Activa => 'Activa',
            self::PruebaGratuita => 'Prueba gratuita',
            self::Programada => 'Programada',
            self::Pausada => 'Pausada',
            self::ActivaConPausa => 'Activa*',
            self::CancelacionSolicitada => 'Cancelación solicitada',
            self::Impagado => 'Impagado',
            self::Cancelada => 'Cancelada',
            self::Vencida => 'Vencida',
        };
    }

    public static function getLabels(): array
    {
        return [
            self::Activa->value => self::Activa->getLabel(),
            self::PruebaGratuita->value => self::PruebaGratuita->getLabel(),
            self::Programada->value => self::Programada->getLabel(),
            self::Pausada->value => self::Pausada->getLabel(),
            self::ActivaConPausa->value => self::ActivaConPausa->getLabel(),
            self::CancelacionSolicitada->value => self::CancelacionSolicitada->getLabel(),
            self::Impagado->value => self::Impagado->getLabel(),
            self::Cancelada->value => self::Cancelada->getLabel(),
            self::Vencida->value => self::Vencida->getLabel(),
        ];
    }



}
