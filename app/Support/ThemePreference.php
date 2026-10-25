<?php

namespace App\Support;

use Illuminate\Http\Request;

class ThemePreference
{
    public const SESSION_KEY = 'theme_preference';

    /**
     * @var array<string, list<string>>
     */
    public const OPTIONS = [
        'data-layout' => ['vertical', 'horizontal', 'twocolumn'],
        'data-bs-theme' => ['light', 'dark'],
        'data-layout-width' => ['fluid', 'boxed'],
        'data-topbar' => ['light', 'dark'],
        'data-sidebar-size' => ['lg', 'md', 'sm', 'sm-hover', 'sm-hover-active'],
        'data-layout-style' => ['default', 'detached'],
        'data-sidebar' => ['light', 'dark', 'gradient', 'gradient-2', 'gradient-3', 'gradient-4'],
        'data-sidebar-image' => ['none', 'img-1', 'img-2', 'img-3', 'img-4'],
        'data-preloader' => ['enable', 'disable'],
        'data-layout-auto' => ['true', 'false'],
    ];

    /**
     * @return array<string, string>
     */
    public static function defaults(): array
    {
        return [
            'data-layout' => 'vertical',
            'data-bs-theme' => 'light',
            'data-layout-width' => 'fluid',
            'data-topbar' => 'light',
            'data-sidebar-size' => 'lg',
            'data-layout-style' => 'default',
            'data-sidebar' => 'dark',
            'data-sidebar-image' => 'img-1',
            'data-preloader' => 'disable',
            'data-layout-auto' => 'false',
        ];
    }

    /**
     * @return array<string, string>
     */
    public static function all(): array
    {
        $stored = session(self::SESSION_KEY, []);
        $theme = self::defaults();

        if (! is_array($stored)) {
            return $theme;
        }

        foreach (self::OPTIONS as $key => $allowed) {
            $value = $stored[$key] ?? null;

            if (is_string($value) && in_array($value, $allowed, true)) {
                $theme[$key] = $value;
            }
        }

        return $theme;
    }

    /**
     * @return array<string, string>
     */
    public static function htmlAttributes(): array
    {
        $theme = self::all();
        unset($theme['data-layout-auto']);

        return $theme;
    }

    public static function htmlAttributeString(): string
    {
        return collect(self::htmlAttributes())
            ->map(fn (string $value, string $name) => $name.'="'.e($value).'"')
            ->implode(' ');
    }

    /**
     * @return array<string, string>
     */
    public static function store(Request $request): array
    {
        $theme = self::all();

        foreach (self::OPTIONS as $key => $allowed) {
            $value = $request->input($key);

            if (is_string($value) && in_array($value, $allowed, true)) {
                $theme[$key] = $value;
            }
        }

        session([self::SESSION_KEY => $theme]);
        $request->session()->save();

        return self::all();
    }

    public static function forget(): void
    {
        session()->forget(self::SESSION_KEY);
        session()->save();
    }
}
