<?php

namespace App\Traits;

use Carbon\Carbon;
use Morilog\Jalali\Jalalian;
use Throwable;

trait ConvertsJalaliDates
{
    public function setAttribute($key, $value)
    {
        if (in_array($key, $this->jalaliDateAttributes(), true)) {
            $value = static::toGregorianDate($value);
        }

        return parent::setAttribute($key, $value);
    }

    public function jalaliDate(string $attribute, string $format = 'Y/m/d'): ?string
    {
        return static::toJalaliDate($this->getAttribute($attribute), $format);
    }

    /**
     * @return list<string>
     */
    protected function jalaliDateAttributes(): array
    {
        return [];
    }

    public static function toGregorianDate(mixed $value): ?string
    {
        if ($value === null || $value === '') {
            return null;
        }

        if ($value instanceof \DateTimeInterface) {
            return Carbon::instance(\DateTime::createFromInterface($value))->format('Y-m-d');
        }

        $value = static::normalizeDateDigits(trim((string) $value));

        if (! preg_match('/^(?<year>\d{4})[\/\-](?<month>\d{1,2})[\/\-](?<day>\d{1,2})$/', $value, $matches)) {
            return $value;
        }

        $normalized = sprintf('%04d/%02d/%02d', $matches['year'], $matches['month'], $matches['day']);

        try {
            if ((int) $matches['year'] < 1700) {
                return Jalalian::fromFormat('Y/m/d', $normalized)->toCarbon()->format('Y-m-d');
            }

            return Carbon::createFromFormat('!Y/m/d', $normalized)->format('Y-m-d');
        } catch (Throwable) {
            return $value;
        }
    }

    public static function toJalaliDate(mixed $value, string $format = 'Y/m/d'): ?string
    {
        if ($value === null || $value === '') {
            return null;
        }

        if (is_string($value)) {
            $normalized = static::normalizeDateDigits(trim($value));

            if (preg_match('/^(?<year>\d{4})\/(?<month>\d{1,2})\/(?<day>\d{1,2})$/', $normalized, $matches) && (int) $matches['year'] < 1700) {
                try {
                    return Jalalian::fromFormat(
                        'Y/m/d',
                        sprintf('%04d/%02d/%02d', $matches['year'], $matches['month'], $matches['day'])
                    )->format($format);
                } catch (Throwable) {
                    return $value;
                }
            }
        }

        try {
            $carbon = $value instanceof \DateTimeInterface
                ? Carbon::instance(\DateTime::createFromInterface($value))
                : Carbon::parse(is_string($value) ? static::normalizeDateDigits(trim($value)) : $value);

            return Jalalian::fromCarbon($carbon)->format($format);
        } catch (Throwable) {
            return is_string($value) ? $value : null;
        }
    }

    private static function normalizeDateDigits(string $value): string
    {
        return strtr($value, [
            '۰' => '0', '۱' => '1', '۲' => '2', '۳' => '3', '۴' => '4',
            '۵' => '5', '۶' => '6', '۷' => '7', '۸' => '8', '۹' => '9',
            '٠' => '0', '١' => '1', '٢' => '2', '٣' => '3', '٤' => '4',
            '٥' => '5', '٦' => '6', '٧' => '7', '٨' => '8', '٩' => '9',
        ]);
    }
}
