<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Homecell;
use App\Models\Ministry;
use App\Models\Member;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Total counts
        $totalUsers = User::count();
        $totalMembers = Member::count();
        $totalHomecells = Homecell::count();
        $totalMinistries = Ministry::count();

        // Members grouped by ministry
        $membersByMinistry = Ministry::withCount('members')->get();

        // Members grouped by homecell
        $membersByHomecell = Homecell::withCount('members')->get();

        // Members by age group
        $ageGroups = [
            'Under 18' => Member::whereDate('dob', '>', Carbon::now()->subYears(18))->count(),
            '18-25' => Member::whereDate('dob', '<=', Carbon::now()->subYears(18))
                             ->whereDate('dob', '>', Carbon::now()->subYears(25))->count(),
            '26-35' => Member::whereDate('dob', '<=', Carbon::now()->subYears(25))
                             ->whereDate('dob', '>', Carbon::now()->subYears(35))->count(),
            '36-50' => Member::whereDate('dob', '<=', Carbon::now()->subYears(35))
                             ->whereDate('dob', '>', Carbon::now()->subYears(50))->count(),
            '51+' => Member::whereDate('dob', '<=', Carbon::now()->subYears(50))->count(),
        ];

        return view('dashboard', compact(
            'totalUsers',
            'totalMembers',
            'totalHomecells',
            'totalMinistries',
            'membersByMinistry',
            'membersByHomecell',
            'ageGroups'
        ));
    }
}
