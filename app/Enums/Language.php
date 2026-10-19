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
            self::Dari => __('common.lang_dari'),
            self::Pashto => __('common.lang_pashto'),
            self::English => __('common.lang_english'),
            self::All => __('common.lang_all'),
        };
    }
}
