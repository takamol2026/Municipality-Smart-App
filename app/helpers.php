<?php

use App\Models\Announcement;

function jalali_date(mixed $value, string $format = 'Y/m/d'): ?string
{
    return Announcement::toJalaliDate($value, $format);
}
