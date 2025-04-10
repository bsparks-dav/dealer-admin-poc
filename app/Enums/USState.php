<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum USState: string implements HasLabel
{
    case AL = 'AL';
    case AK = 'AK';
    case AZ = 'AZ';
    case AR = 'AR';
    case CA = 'CA';
    case CO = 'CO';
    case CT = 'CT';
    case DC = 'DC';
    case DE = 'DE';
    case FL = 'FL';
    case GA = 'GA';
    case GU = 'GU';
    case HI = 'HI';
    case ID = 'ID';
    case IL = 'IL';
    case IN = 'IN';
    case IA = 'IA';
    case KS = 'KS';
    case KY = 'KY';
    case LA = 'LA';
    case ME = 'ME';
    case MD = 'MD';
    case MA = 'MA';
    case MI = 'MI';
    case MN = 'MN';
    case MS = 'MS';
    case MO = 'MO';
    case MT = 'MT';
    case NE = 'NE';
    case NV = 'NV';
    case NH = 'NH';
    case NJ = 'NJ';
    case NM = 'NM';
    case NY = 'NY';
    case NC = 'NC';
    case ND = 'ND';
    case OH = 'OH';
    case OK = 'OK';
    case OR = 'OR';
    case PA = 'PA';
    case PR = 'PR';
    case RI = 'RI';
    case SC = 'SC';
    case SD = 'SD';
    case TN = 'TN';
    case TX = 'TX';
    case UT = 'UT';
    case VI = 'VI';
    case VT = 'VT';
    case VA = 'VA';
    case WA = 'WA';
    case WV = 'WV';
    case WI = 'WI';
    case WY = 'WY';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::AL => 'Alabama',
            self::AK => 'Alaska',
            self::AZ => 'Arizona',
            self::AR => 'Arkansas',
            self::CA => 'California',
            self::CO => 'Colorado',
            self::CT => 'Connecticut',
            self::DC => 'District of Columbia',
            self::DE => 'Delaware',
            self::FL => 'Florida',
            self::GA => 'Georgia',
            self::GU => 'Guam',
            self::HI => 'Hawaii',
            self::ID => 'Idaho',
            self::IL => 'Illinois',
            self::IN => 'Indiana',
            self::IA => 'Iowa',
            self::KS => 'Kansas',
            self::KY => 'Kentucky',
            self::LA => 'Louisiana',
            self::ME => 'Maine',
            self::MD => 'Maryland',
            self::MA => 'Massachusetts',
            self::MI => 'Michigan',
            self::MN => 'Minnesota',
            self::MS => 'Mississippi',
            self::MO => 'Missouri',
            self::MT => 'Montana',
            self::NE => 'Nebraska',
            self::NV => 'Nevada',
            self::NH => 'New Hampshire',
            self::NJ => 'New Jersey',
            self::NM => 'New Mexico',
            self::NY => 'New York',
            self::NC => 'North Carolina',
            self::ND => 'North Dakota',
            self::OH => 'Ohio',
            self::OK => 'Oklahoma',
            self::OR => 'Oregon',
            self::PA => 'Pennsylvania',
            self::PR => 'Puerto Rico',
            self::RI => 'Rhode Island',
            self::SC => 'South Carolina',
            self::SD => 'South Dakota',
            self::TN => 'Tennessee',
            self::TX => 'Texas',
            self::UT => 'Utah',
            self::VT => 'Vermont',
            self::VI => 'Virgin Islands',
            self::VA => 'Virginia',
            self::WA => 'Washington',
            self::WV => 'West Virginia',
            self::WI => 'Wisconsin',
            self::WY => 'Wyoming'
        };
    }

    public static function formatStateCode(?string $stateCode): string
    {
        if (empty($stateCode)) {
            return '';
        }

        try {
            return self::from($stateCode)->getLabel();
        } catch (\ValueError $e) {
            return $stateCode;
        }
    }

}
