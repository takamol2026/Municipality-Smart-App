<?php

namespace App\Enums;

enum SocialNetwork: string
{
    case Facebook = 'facebook';
    case Instagram = 'instagram';
    case X = 'x';
    case YouTube = 'youtube';
    case Telegram = 'telegram';
    case WhatsApp = 'whatsapp';
    case LinkedIn = 'linkedin';
    case TikTok = 'tiktok';

    public function label(): string
    {
        return __('social_links.networks.'.$this->value);
    }
}
