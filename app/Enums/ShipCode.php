<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum ShipCode: string implements HasLabel
{
    case KEY_01 = 'KEY_01';
    case KEY_02 = 'KEY_02';
    case KEY_03 = 'KEY_03';
    case KEY_CF = 'KEY_CF';
    case KEY_D = 'KEY_D';
    case KEY_DS = 'KEY_DS';
    case KEY_F = 'KEY_F';
    case KEY_FE = 'KEY_FE';
    case KEY_FS = 'KEY_FS';
    case KEY_M = 'KEY_M';
    case KEY_PL = 'KEY_PL';
    case KEY_PR = 'KEY_PR';
    case KEY_PU = 'KEY_PU';
    case KEY_R = 'KEY_R';
    case KEY_SD = 'KEY_SD';
    case KEY_SS = 'KEY_SS';
    case KEY_T = 'KEY_T';
    case KEY_U = 'KEY_U';
    case KEY_UG = 'KEY_UG';
    case KEY_Y = 'KEY_Y';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::KEY_01 => 'UPS NEXT SAVER',
            self::KEY_02 => 'FEDEX 2ND DAY AIR',
            self::KEY_03 => 'FEDEX XPR SAVER',
            self::KEY_CF => 'CONSOLIDATED',
            self::KEY_D => 'STAFF DELIVERED',
            self::KEY_DS => 'DROP SHIPPED',
            self::KEY_F => 'FEDEX FREIGHT',
            self::KEY_FE => 'FEDEX PRIORITY',
            self::KEY_FS => 'FEDEX STANDARD',
            self::KEY_M => 'U.S. MAIL',
            self::KEY_PL => 'SAME DAY PICKUP',
            self::KEY_PR => 'PRIORITY MAIL',
            self::KEY_PU => 'CUSTOMER PICKUP',
            self::KEY_R => 'ROADWAY',
            self::KEY_SD => 'FEDEX PRIORITY SATURDAY',
            self::KEY_SS => 'RED SATURDAY SHIP',
            self::KEY_T => 'TRUCK',
            self::KEY_U => 'FEDEX GROUND',
            self::KEY_UG => 'UPS GROUND',
            self::KEY_Y => 'YELLOW FREIGHT',
        };
    }

    public static function formatShipCode(?string $shipCode): string
    {
        if (! empty($shipCode)) {
            try {
                return self::from($shipCode)->getLabel();
            } catch (\ValueError $e) {
                return $shipCode;
            }
        } else {
            return '';
        }
    }
}
