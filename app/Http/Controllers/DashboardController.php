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
            '0-17' => 0,
            '18-25' => 0,
            '26-35' => 0,
            '36-50' => 0,
            '51+' => 0,
        ];
        foreach (Member::all() as $member) {
            $age = now()->diffInYears(Carbon::parse($member->dob));
            if ($age <= 17) $ageGroups['0-17']++;
            elseif ($age <= 25) $ageGroups['18-25']++;
            elseif ($age <= 35) $ageGroups['26-35']++;
            elseif ($age <= 50) $ageGroups['36-50']++;
            else $ageGroups['51+']++;
        }

        // Birthdays this month
        $currentMonth = Carbon::now()->month;
        $birthdaysThisMonth = Member::whereMonth('dob', $currentMonth)->get()->map(function($member) {
            $member->formatted_dob = Carbon::parse($member->dob)->format('d M'); // format day nicely
            return $member;
        });

        return view('dashboard', compact(
            'totalUsers',
            'totalMembers',
            'totalHomecells',
            'totalMinistries',
            'membersByMinistry',
            'membersByHomecell',
            'ageGroups',
            'birthdaysThisMonth' // pass to view
        ));
    }
}
