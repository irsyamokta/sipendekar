<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomepageController extends Controller
{
    public function index(Request $request)
    {
        $request->session()->flush();
        return view('client.page.homepage.homepage');
    }

    public function screening(Request $request)
    {
        $request->session()->flush();
        return view('client.page.screening.page.screening');
    }

    public function mandiri(Request $request)
    {
        $request->session()->flush();
        return view('client.page.mandiri.page.mandiri');
    }
}
