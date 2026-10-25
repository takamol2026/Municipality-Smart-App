<?php

namespace Database\Seeders;

use App\Enums\Language;
use App\Enums\LicenseOnlineServiceType;
use App\Enums\RecordStatus;
use App\Models\LicenseOnlineService;
use App\Models\LicenseOnlineServiceFile;
use Database\Seeders\Concerns\UpsertsSeed;
use Illuminate\Database\Seeder;

class LicenseOnlineServiceSeeder extends Seeder
{
    use UpsertsSeed;

    public function run(): void
    {
        $userId = $this->adminId();
        $languages = [Language::Dari, Language::Pashto, Language::English, Language::All];

        $licenses = [
            'جواز ساختمانی',
            'جواز تجارت',
            'جواز فعالیت صحی',
            'جواز رستورانت',
            'جواز تبلیغات',
            'جواز حفریات',
            'جواز کارگاه',
            'جواز حمل‌ونقل',
        ];

        $forms = [
            'فورم درخواست جواز سیر',
            'فورم ثبت ملکیت',
            'فورم شکایت شهری',
            'فورم تمدید جواز',
            'فورم تغییر نقشه',
            'فورم درخواست نوسازی',
            'فورم پرداخت محصول',
            'فورم معلومات عمومی',
        ];

        for ($i = 1; $i <= 100; $i++) {
            $isLicense = $i % 2 === 1;
            $title = $isLicense
                ? $licenses[($i - 1) % count($licenses)]
                : $forms[($i - 1) % count($forms)];

            $service = $this->upsert(LicenseOnlineService::class, [
                'name' => "{$title} {$i}",
            ], [
                'type' => $isLicense ? LicenseOnlineServiceType::LicenseRequest : LicenseOnlineServiceType::OnlineForm,
                'lang' => $languages[($i - 1) % count($languages)],
                'description' => "توضیحات {$title} شماره {$i}.\nاین مورد برای راهنمایی مراجعه‌کنندگان شاروالی هرات ثبت شده است.",
                'status' => $i % 10 === 0 ? RecordStatus::Inactive : RecordStatus::Active,
                'sort_order' => $i,
                'user_id' => $userId,
            ]);

            $this->upsert(LicenseOnlineServiceFile::class, [
                'license_online_service_id' => $service->id,
                'file_path' => "license-online-services/files/item-{$i}.pdf",
            ], [
                'file_name' => $isLicense ? "جواز-{$i}.pdf" : "فورم-{$i}.pdf",
                'file_type' => 'application/pdf',
                'file_size' => 120000 + ($i * 1024),
            ]);

            if ($i % 3 === 0) {
                $this->upsert(LicenseOnlineServiceFile::class, [
                    'license_online_service_id' => $service->id,
                    'file_path' => "license-online-services/files/item-{$i}-guide.docx",
                ], [
                    'file_name' => "رهنما-{$i}.docx",
                    'file_type' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                    'file_size' => 80000 + ($i * 512),
                ]);
            }
        }
    }
}
