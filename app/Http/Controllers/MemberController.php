<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Homecell;
use App\Models\Ministry;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $query = Member::with(['homecell', 'ministry']);
        $query = $this->applyFilters($query, $request);

        $members = $query->latest()->paginate(12)->withQueryString();

        $statsQuery = $this->applyFilters(Member::query(), $request);

        return view('members.index', [
            'members' => $members,
            'homecells' => Homecell::all(),
            'ministries' => Ministry::all(),
            'totalMembers' => $statsQuery->count(),
            'activeMembers' => (clone $statsQuery)->where('active', true)->count(),
            'transferredMembers' => (clone $statsQuery)->where('transferred', true)->count(),
            'deceasedMembers' => (clone $statsQuery)->where('deceased', true)->count(),
        ]);
    }

    public function create()
    {
        $homecells = Homecell::all();
        $ministries = Ministry::all();

        return view('members.create', compact('homecells', 'ministries'));
    }

    public function store(Request $request)
    {
        $data = $this->validateMember($request);

        if ($request->hasFile('picture')) {
            $data['picture'] = $request->file('picture')->store('members', 'public');
        }

        Member::create($data);

        return redirect()->route('members.index')->with('success', 'Member added successfully.');
    }

    public function edit(Member $member)
    {
        $homecells = Homecell::all();
        $ministries = Ministry::all();

        return view('members.edit', compact('member', 'homecells', 'ministries'));
    }

    protected function validateMember(Request $request): array
    {
        return $request->validate([
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'dob' => 'required|date',
            'gender' => 'required|in:male,female',
            'homecell_id' => 'nullable|exists:homecells,id',
            'ministry_id' => 'nullable|exists:ministries,id',
            'picture' => 'nullable|image|max:2048',
            'active' => 'boolean',
            'transferred' => 'boolean',
            'deceased' => 'boolean',
        ]);
    }

    protected function applyFilters($query, Request $request)
    {
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('surname', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('homecell_id')) {
            $query->where('homecell_id', $request->homecell_id);
        }

        if ($request->filled('ministry_id')) {
            $query->where('ministry_id', $request->ministry_id);
        }

        return $query;
    }
}
