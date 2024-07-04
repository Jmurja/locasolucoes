<?php

namespace App\Enum;

enum RentalItemStatus: string
{
    case available   = 'available';
    case reserved    = 'reserved';
    case maintenance = 'maintenance';

    public function label(): string
    {
        return match ($this) {
            self::available   => 'Disponivel',
            self::reserved    => 'Reservado',
            self::maintenance => 'Manutenção',
        };
    }

    public static function options(): array
    {
        return array_map(
            fn($status) => ['value' => $status->value, 'label' => $status->label()],
            self::cases()
        );
    }
}
