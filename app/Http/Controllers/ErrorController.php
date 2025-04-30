<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ErrorController extends Controller
{
    public function unauthorized()
    {
        return view('unauthorized');
    }

    public function notFound()
    {
        return view('errors.404');
    }

    public function serverError()
    {
        return view('errors.500');
    }
}
