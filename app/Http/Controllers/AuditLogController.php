<?php

namespace App\Http\Controllers;

use App\Enums\AuditAction;
use App\Models\Announcement;
use App\Models\AuditLog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AuditLogController extends Controller
{
    public function index(Request $request): View
    {
        $logs = AuditLog::query()
            ->with('user')
            ->when($request->filled('user_id'), function ($query) use ($request) {
                if ($request->string('user_id')->toString() === 'guest') {
                    $query->whereNull('user_id');

                    return;
                }

                $query->where('user_id', $request->integer('user_id'));
            })
            ->when($request->filled('action'), function ($query) use ($request) {
                $action = AuditAction::tryFrom($request->string('action')->toString());

                if ($action !== null) {
                    $query->where('action', $action->value);
                }
            })
            ->when($request->filled('subject'), function ($query) use ($request) {
                $subject = $request->string('subject')->toString();

                if ($subject === 'auth') {
                    $query->whereNull('auditable_type');

                    return;
                }

                if (in_array($subject, AuditLog::subjectTypes(), true)) {
                    $query->where('auditable_type', $subject);
                }
            })
            ->when($request->filled('q'), function ($query) use ($request) {
                $term = '%'.$request->string('q').'%';

                $query->where(function ($inner) use ($term) {
                    $inner->where('record_label', 'like', $term)
                        ->orWhere('ip_address', 'like', $term)
                        ->orWhereHas('user', function ($user) use ($term) {
                            $user->where('name', 'like', $term)
                                ->orWhere('last_name', 'like', $term)
                                ->orWhere('username', 'like', $term);
                        });
                });
            })
            ->when($from = $this->gregorianDate($request->input('from')), function ($query) use ($from) {
                $query->where('created_at', '>=', $from.' 00:00:00');
            })
            ->when($to = $this->gregorianDate($request->input('to')), function ($query) use ($to) {
                $query->where('created_at', '<=', $to.' 23:59:59');
            })
            ->latest('id')
            ->paginate(15)
            ->withQueryString();

        $users = User::query()
            ->orderBy('name')
            ->orderBy('last_name')
            ->get(['id', 'name', 'last_name', 'username']);

        return view('audit-logs.index', [
            'logs' => $logs,
            'users' => $users,
            'actions' => AuditAction::cases(),
            'subjects' => AuditLog::subjectTypes(),
        ]);
    }

    private function gregorianDate(mixed $value): ?string
    {
        if (! is_string($value) || trim($value) === '') {
            return null;
        }

        $converted = Announcement::toGregorianDate($value);

        return is_string($converted) && preg_match('/^\d{4}-\d{2}-\d{2}$/', $converted) === 1
            ? $converted
            : null;
    }
}
