<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum PaymentTerm: string implements HasLabel
{
    case KEY_10 = 'KEY_10';
    case KEY_15 = 'KEY_15';
    case KEY_1P = 'KEY_1P';
    case KEY_2P = 'KEY_2P';
    case KEY_45 = 'KEY_45';
    case KEY_60 = 'KEY_60';
    case KEY_90 = 'KEY_90';
    case KEY_AV = 'KEY_AV';
    case KEY_C = 'KEY_C';
    case KEY_CC = 'KEY_CC';
    case KEY_CX = 'KEY_CX';
    case KEY_EC = 'KEY_EC';
    case KEY_GS = 'KEY_GS';
    case KEY_H = 'KEY_H';
    case KEY_M = 'KEY_M';
    case KEY_MA = 'KEY_MA';
    case KEY_MC = 'KEY_MC';
    case KEY_N = 'KEY_N';
    case KEY_NX = 'KEY_NX';
    case KEY_O = 'KEY_O';
    case KEY_R = 'KEY_R';
    case KEY_RG = 'KEY_RG';
    case KEY_S = 'KEY_S';
    case KEY_SA = 'KEY_SA';
    case KEY_SX = 'KEY_SX';
    case KEY_TR = 'KEY_TR';
    case KEY_V = 'KEY_V';
    case KEY_X = 'KEY_X';
    case KEY_XX = 'KEY_XX';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::KEY_10 => 'NET 10 EOM',
            self::KEY_15 => 'NET 15 DAYS',
            self::KEY_1P => '1% 30/NET 31',
            self::KEY_2P => '2% 30/NET 31',
            self::KEY_45 => 'DUE NET 45 DAYS',
            self::KEY_60 => 'DUE NET 60 DAYS',
            self::KEY_90 => 'DUE NET 90 DAYS',
            self::KEY_AV => 'FEDEX PRIORITY',
            self::KEY_C => 'C.O.D. CERT/MO',
            self::KEY_CC => 'C.O.D. CHECK',
            self::KEY_CX => 'FAX CHECK - CHAX',
            self::KEY_EC => 'Electronic Check',
            self::KEY_GS => 'Credit Card',
            self::KEY_H => 'HOLD CASH/CERT',
            self::KEY_M => 'MONEY',
            self::KEY_MA => 'RED SATURDAY SHIP',
            self::KEY_MC => 'MASTERCARD',
            self::KEY_N => 'NSF IN HOUSE',
            self::KEY_NX => 'NSF - COLLECTION',
            self::KEY_O => 'DUE NET 30 DAYS',
            self::KEY_R => 'REPAIRS',
            self::KEY_RG => 'Receipt of Goods',
            self::KEY_S => 'SAMPLE A/C',
            self::KEY_SA => 'Pmt Arrangement',
            self::KEY_SX => 'DO NOT SHIP',
            self::KEY_TR => 'Terms Review',
            self::KEY_V => 'VISA',
            self::KEY_X => 'At Collection',
            self::KEY_XX => 'Bad Debt',
        };
    }

    public static function formatPaymentTerm(?string $paymentTerm): string
    {
        if (! empty($paymentTerm)) {
            try {
                return self::from($paymentTerm)->getLabel();
            } catch (\ValueError $e) {
                return $paymentTerm;
            }
        } else {
            return '';
        }
    }
}
