<?php

namespace App\Http\Controllers\Api;

use App\Enums\Language;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

abstract class ApiController extends Controller
{
    protected function perPage(Request $request): int
    {
        return min(max($request->integer('per_page', 15), 1), 100);
    }

    protected function paginated(LengthAwarePaginator $paginator, callable $transform): JsonResponse
    {
        return response()->json([
            'data' => $paginator->getCollection()->map($transform)->values(),
            'meta' => [
                'current_page' => $paginator->currentPage(),
                'last_page' => $paginator->lastPage(),
                'per_page' => $paginator->perPage(),
                'total' => $paginator->total(),
            ],
            'links' => [
                'first' => $paginator->url(1),
                'last' => $paginator->url($paginator->lastPage()),
                'prev' => $paginator->previousPageUrl(),
                'next' => $paginator->nextPageUrl(),
            ],
        ]);
    }

    protected function view(string $name): Builder
    {
        return DB::table($name);
    }

    protected function findView(string $name, int $id): object
    {
        return $this->view($name)->where('id', $id)->firstOrFail();
    }

    protected function applySearch(Builder $query, Request $request, string $column): void
    {
        if ($request->filled('search')) {
            $query->where($column, 'like', '%'.$request->string('search').'%');
        }
    }

    /**
     * @param  iterable<int, mixed>  $ids
     */
    protected function rowsFor(string $view, string $foreignKey, iterable $ids): Collection
    {
        $ids = collect($ids)->filter(fn ($id) => $id !== null && $id !== '')->values();

        if ($ids->isEmpty()) {
            return collect();
        }

        return $this->view($view)->whereIn($foreignKey, $ids)->get();
    }

    protected function viewUrl(?string $path): ?string
    {
        if ($path === null || $path === '') {
            return null;
        }

        if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
            return $path;
        }

        return url(ltrim($path, '/'));
    }

    protected function langLabel(mixed $lang): ?string
    {
        $value = $this->enumValue($lang);

        return $value === null ? null : Language::tryFrom($value)?->label();
    }

    protected function iso(mixed $value): ?string
    {
        if ($value === null || $value === '') {
            return null;
        }

        return Carbon::parse($value)->toIso8601String();
    }

    protected function day(mixed $value): ?string
    {
        if ($value === null || $value === '') {
            return null;
        }

        return Carbon::parse($value)->format('Y-m-d');
    }

    /**
     * @return array{id: int, name: mixed, slug: mixed}|null
     */
    protected function categoryOf(object $row): ?array
    {
        if ($row->category_id === null) {
            return null;
        }

        return [
            'id' => (int) $row->category_id,
            'name' => $row->category_name,
            'slug' => $row->category_slug,
        ];
    }

    protected function mediaTypeLabel(?string $type): string
    {
        return match ($type) {
            'image' => __('common.image'),
            'video' => __('common.video'),
            'document' => __('common.document'),
            default => $type ?: '—',
        };
    }

    protected function fileUrl(?string $path): ?string
    {
        if ($path === null || $path === '') {
            return null;
        }

        if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
            return $path;
        }

        return url('storage/'.ltrim($path, '/'));
    }

    protected function enumValue(mixed $value): ?string
    {
        if ($value instanceof \BackedEnum) {
            return (string) $value->value;
        }

        return $value === null ? null : (string) $value;
    }

    protected function date(mixed $value): ?string
    {
        return $value instanceof \DateTimeInterface ? $value->format('Y-m-d') : null;
    }
}
