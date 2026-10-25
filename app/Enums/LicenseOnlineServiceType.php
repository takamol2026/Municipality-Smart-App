<?php

namespace App\Enums;

enum LicenseOnlineServiceType: string
{
    case LicenseRequest = 'license_request';
    case OnlineForm = 'online_form';

    public function label(): string
    {
        return match ($this) {
            self::LicenseRequest => __('license_online_services.types.license_request'),
            self::OnlineForm => __('license_online_services.types.online_form'),
        };
    }
}
