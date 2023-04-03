<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use \Illuminate\Support\Facades\Auth;

class Dashboard extends Controller
{
    /**
     * @param Request $request
     * @return View|Application|Factory|\Illuminate\Contracts\Foundation\Application
     */
    public function index(Request $request, ): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('dashboard', [
            'title' =>'Dashboard',
            'user' => Auth::user()
        ]);
    }
}
