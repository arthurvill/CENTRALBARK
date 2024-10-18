<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function home()
    {
        return view('main.pages.home', [
            'services' => Service::all(),
        ] );
    }

    public function about()
    {
        return view('main.pages.about');
    }

    
    public function faqs()
    {
        return view('main.pages.faqs');
    }
}