<?php

namespace App\Http\Controllers;

use App\Models\Archive;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $archives = Archive::where('user_id', Auth::id())->paginate(10);
        return view('dashboard', [
            'archives' => $archives
        ]);
    }
}
