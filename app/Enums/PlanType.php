<?php

namespace App\Enums;

enum PlanType: string
{
    case Tiempo = 'Tiempo';
    case Dias = 'Dias';
    case PruebaGratuita = 'Prueba Gratuita';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::Tiempo => 'Tiempo',
            self::Dias => 'Dias',
            self::PruebaGratuita => 'Prueba Gratuita',
        };


    }

    public static function getLabels():array
    {
        return [
            self::Tiempo->value => self::Tiempo->getLabel(),
            self::Dias->value => self::Dias->getLabel(),
            self::PruebaGratuita->value => self::PruebaGratuita->getLabel(),
        ];

    }



}
