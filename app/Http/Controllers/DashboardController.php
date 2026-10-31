<?php

namespace App\Http\Controllers;

use App\Enums\PublishStatus;
use App\Models\Announcement;
use App\Models\AuditLog;
use App\Models\District;
use App\Models\HistoricalAttraction;
use App\Models\LicenseOnlineService;
use App\Models\MapLocation;
use App\Models\Project;
use App\Models\Rental;
use App\Models\SafaeiPhoto;
use App\Models\Scholar;
use App\Models\SocialLink;
use App\Models\UrbanService;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $stats = [
            [
                'key' => 'users',
                'label' => __('sidebar.users'),
                'count' => User::count(),
                'icon' => 'bx bx-user-circle',
                'color' => 'primary',
                'route' => route('users.index'),
                'sparkline' => $this->monthlyCounts(User::class),
            ],
            [
                'key' => 'projects',
                'label' => __('sidebar.projects'),
                'count' => Project::count(),
                'icon' => 'bx bx-briefcase',
                'color' => 'success',
                'route' => route('projects.index'),
                'sparkline' => $this->monthlyCounts(Project::class),
            ],
            [
                'key' => 'announcements',
                'label' => __('sidebar.announcements'),
                'count' => Announcement::count(),
                'icon' => 'bx bx-news',
                'color' => 'warning',
                'route' => route('announcements.index'),
                'sparkline' => $this->monthlyCounts(Announcement::class),
            ],
            [
                'key' => 'map',
                'label' => __('sidebar.map'),
                'count' => MapLocation::count(),
                'icon' => 'bx bx-map',
                'color' => 'info',
                'route' => route('map-locations.index'),
                'sparkline' => $this->monthlyCounts(MapLocation::class),
            ],
        ];

        $tiles = [
            [
                'label' => __('sidebar.districts'),
                'count' => District::count(),
                'color' => 'primary',
                'route' => route('districts.index'),
            ],
            [
                'label' => __('sidebar.urban_services'),
                'count' => UrbanService::count(),
                'color' => 'secondary',
                'route' => route('urban-services.index'),
            ],
            [
                'label' => __('sidebar.historical'),
                'count' => HistoricalAttraction::count(),
                'color' => 'warning',
                'route' => route('historical-attractions.index'),
            ],
            [
                'label' => __('sidebar.scholars'),
                'count' => Scholar::count(),
                'color' => 'success',
                'route' => route('scholars.index'),
            ],
            [
                'label' => __('sidebar.rentals'),
                'count' => Rental::count(),
                'color' => 'info',
                'route' => route('rentals.index'),
            ],
            [
                'label' => __('sidebar.safaei'),
                'count' => SafaeiPhoto::count(),
                'color' => 'danger',
                'route' => route('safaei.index'),
            ],
            [
                'label' => __('sidebar.license_online_services'),
                'count' => LicenseOnlineService::count(),
                'color' => 'primary',
                'route' => route('license-online-services.index'),
            ],
            [
                'label' => __('sidebar.social_links'),
                'count' => SocialLink::count(),
                'color' => 'info',
                'route' => route('social-links.index'),
            ],
        ];

        $moduleChart = [
            'labels' => [
                __('sidebar.users'),
                __('sidebar.districts'),
                __('sidebar.urban_services'),
                __('sidebar.historical'),
                __('sidebar.scholars'),
                __('sidebar.announcements'),
                __('sidebar.projects'),
                __('sidebar.map'),
                __('sidebar.rentals'),
                __('sidebar.safaei'),
                __('sidebar.license_online_services'),
                __('sidebar.social_links'),
            ],
            'series' => [
                User::count(),
                District::count(),
                UrbanService::count(),
                HistoricalAttraction::count(),
                Scholar::count(),
                Announcement::count(),
                Project::count(),
                MapLocation::count(),
                Rental::count(),
                SafaeiPhoto::count(),
                LicenseOnlineService::count(),
                SocialLink::count(),
            ],
        ];

        $projectStatusChart = [
            'labels' => [
                __('projects.not_started'),
                __('projects.in_progress'),
                __('projects.completed'),
            ],
            'series' => [
                Project::query()->where('status_publish', PublishStatus::NotStarted)->count(),
                Project::query()->where('status_publish', PublishStatus::InProgress)->count(),
                Project::query()->where('status_publish', PublishStatus::Completed)->count(),
            ],
        ];

        $monthlyChart = [
            'labels' => $this->monthLabels(),
            'series' => [
                [
                    'name' => __('sidebar.projects'),
                    'data' => $this->monthlyCounts(Project::class),
                ],
                [
                    'name' => __('sidebar.announcements'),
                    'data' => $this->monthlyCounts(Announcement::class),
                ],
                [
                    'name' => __('sidebar.map'),
                    'data' => $this->monthlyCounts(MapLocation::class),
                ],
            ],
        ];

        $recentAudits = AuditLog::query()
            ->with('user')
            ->latest('id')
            ->limit(8)
            ->get();

        return view('dashboard', compact('stats', 'tiles', 'moduleChart', 'projectStatusChart', 'monthlyChart', 'recentAudits'));
    }

    /**
     * @param  class-string<Model>  $modelClass
     * @return list<int>
     */
    private function monthlyCounts(string $modelClass, int $months = 6): array
    {
        $start = now()->subMonths($months - 1)->startOfMonth();

        $rows = $modelClass::query()
            ->where('created_at', '>=', $start)
            ->get(['created_at'])
            ->countBy(fn (Model $row) => $row->created_at?->format('Y-m'));

        $series = [];

        for ($i = $months - 1; $i >= 0; $i--) {
            $key = now()->subMonths($i)->format('Y-m');
            $series[] = (int) ($rows[$key] ?? 0);
        }

        return $series;
    }

    /**
     * @return list<string>
     */
    private function monthLabels(int $months = 6): array
    {
        $labels = [];

        for ($i = $months - 1; $i >= 0; $i--) {
            $labels[] = now()->subMonths($i)->locale(app()->getLocale())->translatedFormat('M');
        }

        return $labels;
    }
}
