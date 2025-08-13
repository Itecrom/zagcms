<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Homecell;
use App\Models\Ministry;

class DashboardController extends Controller
{
    public function __invoke()
    {
        return view('dashboard', [
            'totalUsers' => User::count(),
            'homecells'  => Homecell::count(),
            'ministries' => Ministry::count(),
        ]);
    }

    public function index()
    {
        return view('dashboard', [
        ]);
    }
}

