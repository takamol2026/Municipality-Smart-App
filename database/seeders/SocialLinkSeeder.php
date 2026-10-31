<?php

namespace Database\Seeders;

use App\Enums\RecordStatus;
use App\Enums\SocialNetwork;
use App\Models\SocialLink;
use Database\Seeders\Concerns\UpsertsSeed;
use Illuminate\Database\Seeder;

class SocialLinkSeeder extends Seeder
{
    use UpsertsSeed;

    public function run(): void
    {
        $userId = $this->adminId();

        $links = [
            [SocialNetwork::Facebook, 'https://facebook.com/herat.municipality', 1],
            [SocialNetwork::Instagram, 'https://instagram.com/herat.municipality', 2],
            [SocialNetwork::X, 'https://x.com/herat.municipality', 3],
            [SocialNetwork::YouTube, 'https://youtube.com/@herat.municipality', 4],
            [SocialNetwork::Telegram, 'https://t.me/herat.municipality', 5],
            [SocialNetwork::WhatsApp, 'https://wa.me/93700000000', 6],
        ];

        foreach ($links as [$network, $url, $order]) {
            $this->upsert(SocialLink::class, ['network' => $network->value, 'url' => $url], [
                'status' => RecordStatus::Active,
                'sort_order' => $order,
                'user_id' => $userId,
            ]);
        }
    }
}
