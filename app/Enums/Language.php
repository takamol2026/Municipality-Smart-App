<?php

namespace App\Enums;

enum Language: string
{
    case Dari = 'fa';
    case Pashto = 'ps';
    case English = 'en';
    case All = 'all';

    public function label(): string
    {
        return match ($this) {
            self::Dari => __('districts.lang_dari'),
            self::Pashto => __('districts.lang_pashto'),
            self::English => __('districts.lang_english'),
            self::All => __('districts.lang_all'),
        };
    }
}
