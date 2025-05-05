<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum LicenseType: string implements HasLabel
{
    case TYPE_01 = 'TYPE_01';
    case TYPE_02 = 'TYPE_02';
    case TYPE_03 = 'TYPE_03';
    case TYPE_06 = 'TYPE_06';
    case TYPE_07 = 'TYPE_07';
    case TYPE_08 = 'TYPE_08';
    case TYPE_09 = 'TYPE_09';
    case TYPE_10 = 'TYPE_10';
    case TYPE_11 = 'TYPE_11';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::TYPE_01 => 'Type 01 - Dealer in Firearms Other Than Destructive Devices',
            self::TYPE_02 => 'Type 02 - Pawnbroker in Firearms Other Than Destructive Devices',
            self::TYPE_03 => 'Type 03 - Collector of Curios and Relics',
            self::TYPE_06 => 'Type 06 - Manufacturer of Ammunition for Firearms Other Than Ammunition for Destructive Devices or Armor Piercing Ammunition',
            self::TYPE_07 => 'Type 07 - Manufacturer of Firearms Other Than Destructive Devices',
            self::TYPE_08 => 'Type 08 - Importer of Firearms Other Than Destructive Devices or Ammunition for Firearms Other Than Destructive Devices, or Ammunition Other Than Armor Piercing Ammunition',
            self::TYPE_09 => 'Type 09 - Dealer in Destructive Devices',
            self::TYPE_10 => 'Type 10 - Manufacturer of Destructive Devices, Ammunition for Destructive Devices or Armor Piercing Ammunition',
            self::TYPE_11 => 'Type 11 - Importer of Destructive Devices, Ammunition for Destructive Devices or Armor Piercing Ammunition',
        };
    }
}
