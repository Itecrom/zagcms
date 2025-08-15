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
        $this->authorizeResource(Member::class, 'member');
    }

    /**
     * Display a listing of members with optional filters.
     */
    public function index(Request $request)
    {
        $user = auth()->user();

        $query = Member::with(['homecell', 'ministry']);

        // Role-based filters
        if ($user->isHomecellPastor()) {
            $query->where('homecell_id', $user->homecell_id);
        } elseif ($user->isMinistryLeader()) {
            $query->where('ministry_id', $user->ministry_id);
        }

        // Apply query filters from request
        if ($request->filled('homecell_id')) {
            $query->where('homecell_id', $request->homecell_id);
        }

        if ($request->filled('ministry_id')) {
            $query->where('ministry_id', $request->ministry_id);
        }

        if ($request->filled('status')) {
            switch ($request->status) {
                case 'active':
                    $query->where('active', true);
                    break;
                case 'transferred':
                    $query->where('transferred', true);
                    break;
                case 'deceased':
                    $query->where('deceased', true);
                    break;
            }
        }

        $members = $query->distinct()->latest()->paginate(12);
        $homecells = Homecell::all();
        $ministries = Ministry::all();

        return view('members.index', compact('members', 'homecells', 'ministries'));
    }

    /**
     * Show the form for creating a new member.
     */
    public function create()
    {
        $user = auth()->user();

        $homecells = Homecell::query()
            ->when($user->isHomecellPastor(), fn($q) => $q->where('id', $user->homecell_id))
            ->get();

        $ministries = Ministry::query()
            ->when($user->isMinistryLeader(), fn($q) => $q->where('id', $user->ministry_id))
            ->get();

        return view('members.create', compact('homecells', 'ministries'));
    }

    /**
     * Store a newly created member in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'              => 'required|string|max:255',
            'surname'           => 'required|string|max:255',
            'dob'               => 'required|date',
            'phone'             => 'nullable|string|max:20',
            'home_of_origin'    => 'nullable|string|max:255',
            'residential_home'  => 'nullable|string|max:255',
            'homecell_id'       => 'required|exists:homecells,id',
            'ministry_id'       => 'required|exists:ministries,id',
            'marital_status'    => 'nullable|string|max:50',
            'employment_status' => 'nullable|string|max:50',
            'active'            => 'sometimes|boolean',
            'transferred'       => 'sometimes|boolean',
            'deceased'          => 'sometimes|boolean',
            'picture'           => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Ensure checkboxes are properly handled
        $data['active']      = $request->has('active');
        $data['transferred'] = $request->has('transferred');
        $data['deceased']    = $request->has('deceased');

        // Handle image upload
        if ($request->hasFile('picture')) {
            $data['picture'] = $request->file('picture')->store('members', 'public');
        }

        Member::create($data);

        return redirect()->route('members.index')->with('success', 'Member added successfully.');
    }

    /**
     * Show the form for editing the specified member.
     */
    public function edit(Member $member)
    {
        $user = auth()->user();

        $homecells = Homecell::query()
            ->when($user->isHomecellPastor(), fn($q) => $q->where('id', $user->homecell_id))
            ->get();

        $ministries = Ministry::query()
            ->when($user->isMinistryLeader(), fn($q) => $q->where('id', $user->ministry_id))
            ->get();

        return view('members.edit', compact('member', 'homecells', 'ministries'));
    }

    /**
     * Update the specified member in storage.
     */
    public function update(Request $request, Member $member)
    {
        $user = auth()->user();

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'dob' => 'required|date',
            'home_of_origin' => 'nullable|string|max:255',
            'residential_home' => 'nullable|string|max:255',
            'homecell_id' => 'required|exists:homecells,id',
            'ministry_id' => 'nullable|exists:ministries,id',
            'picture' => 'nullable|image|max:2048',
            'marital_status' => 'nullable|string|max:255',
            'employment_status' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:30',
            'active' => 'sometimes|boolean',
            'transferred' => 'sometimes|boolean',
            'deceased' => 'sometimes|boolean',
        ]);

        // Role-based restriction
        if ($user->isHomecellPastor()) {
            $data['homecell_id'] = $user->homecell_id;
        }
        if ($user->isMinistryLeader()) {
            $data['ministry_id'] = $user->ministry_id;
        }

        // Ensure checkboxes are properly handled
        $data['active']      = $request->has('active');
        $data['transferred'] = $request->has('transferred');
        $data['deceased']    = $request->has('deceased');

        // Handle image upload
        if ($request->hasFile('picture')) {
            $data['picture'] = $request->file('picture')->store('members', 'public');
        }

        $member->update($data);

        return redirect()->route('members.index')->with('success', 'Member updated successfully!');
    }

    /**
     * Remove the specified member from storage.
     */
    public function destroy(Member $member)
    {
        $member->delete();

        return redirect()->route('members.index')->with('success', 'Member deleted successfully!');
    }
}
