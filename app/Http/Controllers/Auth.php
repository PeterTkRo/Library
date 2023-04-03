<?php

namespace App\Http\Controllers;

use App\Http\Requests\User as UserRequest;
use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth as AuthFacade;
use Illuminate\Support\Facades\Hash;

class Auth extends Controller
{
    /**
     * @return View|Application|Factory|\Illuminate\Contracts\Foundation\Application
     */
    public function index(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('sign', ['title' => 'Login/Register Form']);
    }

    /**
     * @param UserRequest $request
     * @return Application|Redirector|RedirectResponse|\Illuminate\Contracts\Foundation\Application
     */
    public function login(Request $request): Application|Redirector|RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        if(AuthFacade::attempt($request->validate(['name' => 'required', 'password' => 'required']))){
            return redirect(route('mainPage'));
        }
        return redirect(route('SignPage'))->withErrors('Bad name or password');
    }

    public function logout(Request $request)
    {
        if (AuthFacade::check()) {
            AuthFacade::logout();
        }
        return redirect(route('SignPage'));
    }

    /**
     * @param UserRequest $request
     * @return Application|Redirector|RedirectResponse|\Illuminate\Contracts\Foundation\Application
     */
    public function register(UserRequest $request): Application|Redirector|RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        User::query()->create(['name' => $request->validated()['name'], 'password' => Hash::make($request->validated()['password'])]);
        return redirect(route('SignPage'))->with('success','You registered in Library');
    }
}
