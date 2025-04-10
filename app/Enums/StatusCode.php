<?php

namespace App\Enums;

use Filament\Support\Colors\Color;
use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum StatusCode: string implements HasColor, HasIcon, HasLabel
{
    case IN_PROGRESS = 'C';
    case INCOMPLETE = 'I';
    case INVOICED = 'X';
    case SHIPPED = 'Z';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::IN_PROGRESS => 'IN PROGRESS',
            self::INCOMPLETE => 'INCOMPLETE',
            self::INVOICED => 'INVOICED',
            self::SHIPPED => 'SHIPPED',
        };
    }

    public function getIcon(): ?string
    {
        return match ($this) {
            self::IN_PROGRESS => 'heroicon-o-sparkles',
            self::INCOMPLETE => 'heroicon-o-shield-exclamation',
            self::INVOICED => 'heroicon-o-check-badge',
            self::SHIPPED => 'heroicon-o-truck',
        };
    }

    public static function formatStatusCode(?string $statusCode): string
    {
        if (empty($statusCode)) {
            return '';
        }

        try {
            return self::from($statusCode)->getLabel();
        } catch (\ValueError $e) {
            return $statusCode;
        }
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::IN_PROGRESS => 'warning',
            self::INCOMPLETE => 'danger',
            self::INVOICED => 'info',
            self::SHIPPED => 'teal',
        };
    }

    public static function getColorForCode(?string $code): string
    {
        if (empty($code)) {
            return 'primary';
        }

        try {
            return self::from($code)->getColor();
        } catch (\ValueError $e) {
            return 'primary';
        }
    }
}
