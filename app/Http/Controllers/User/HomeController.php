<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Tour;

class HomeController extends Controller
{
    /**
     * Trang chủ
     */
    public function index()
    {
        $tours = Tour::latest()->paginate(6);

        return view('user.home', compact('tours'));
    }
}