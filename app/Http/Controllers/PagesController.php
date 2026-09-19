<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class PagesController extends Controller
{
    public function root()
    {
        //$app = app();
        //dd($app->getLoadedProviders());
        return view('pages.root');
    }

    public function download()
    {
        return redirect('/topics/3');
    }

    public function account()
    {
        if (Auth::check()) {
            return redirect("users/" . Auth::id());
        }
        return redirect('login');
    }

}
