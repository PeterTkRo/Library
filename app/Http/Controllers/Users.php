<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

class Users extends Controller
{
    /**
     * @param Request $request
     * @return View|\Illuminate\Foundation\Application|Factory|Application
     */
    public function index(Request $request): View|\Illuminate\Foundation\Application|Factory|Application
    {
        $users = User::query()->select(['id', 'name', 'role'])->paginate(10);
        if ($users->isEmpty() && User::query()->first('id')->exists()) {
            return redirect(route('admin.users'));
        }
        return view('users', [
            'users' => $users,
            'title' => 'Users',
            'roles' => User::ROLES
        ]);
    }

    /**
     * @param Request $request
     * @param User $user
     * @return Application|\Illuminate\Foundation\Application|RedirectResponse|Redirector
     */
    public function delete(Request $request, User $user): \Illuminate\Foundation\Application|Redirector|RedirectResponse|Application
    {
        $user->delete();
        return redirect()->back()->with('success', 'You success delete User ' . $user->name);
    }
}
