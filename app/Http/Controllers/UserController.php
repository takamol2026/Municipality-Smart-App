<?php

namespace App\Http\Controllers;

use App\Enums\RecordStatus;
use App\Http\Requests\UserStoreValidation;
use App\Http\Requests\UserUpdateValidation;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index(Request $request): View
    {
        $users = User::query()
            ->when($request->filled('name'), function ($query) use ($request) {
                $name = $request->string('name');

                $query->where(function ($inner) use ($name) {
                    $inner->where('name', 'like', '%'.$name.'%')
                        ->orWhere('last_name', 'like', '%'.$name.'%');
                });
            })
            ->when($request->filled('status'), function ($query) use ($request) {
                $query->where('status', $request->string('status'));
            })
            ->latest('id')
            ->paginate(15)
            ->withQueryString();

        return view('users.index', compact('users'));
    }

    public function create(): View
    {
        return view('users.create');
    }

    public function store(UserStoreValidation $request): RedirectResponse
    {
        $validated = $request->validated();
        $validated['status'] = RecordStatus::from($validated['status']);

        User::create($validated);

        return redirect()
            ->route('users.index')
            ->with('success', 'کاربر با موفقیت ذخیره شد.');
    }

    public function edit(User $user): View
    {
        return view('users.edit', compact('user'));
    }

    public function update(UserUpdateValidation $request, User $user): RedirectResponse
    {
        $validated = $request->validated();
        $validated['status'] = RecordStatus::from($validated['status']);

        if (blank($validated['password'] ?? null)) {
            unset($validated['password']);
        }

        $user->update($validated);

        return redirect()
            ->route('users.index')
            ->with('success', 'کاربر با موفقیت ویرایش شد.');
    }

    public function destroy(Request $request, User $user): RedirectResponse
    {
        if ($user->is($request->user())) {
            return redirect()
                ->route('users.index')
                ->with('error', 'حساب کاربری خودتان را نمی‌توانید حذف کنید.');
        }

        try {
            $user->delete();
        } catch (QueryException) {
            return redirect()
                ->route('users.index')
                ->with('error', 'این کاربر به دلیل داشتن اطلاعات مرتبط قابل حذف نیست.');
        }

        return redirect()
            ->route('users.index')
            ->with('success', 'کاربر با موفقیت حذف شد.');
    }
}
