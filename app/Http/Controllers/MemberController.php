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
        // Optionally, add role-based middleware: $this->middleware('role:admin')->except(['index', 'show']);
    }

    public function index()
    {
        $members = Member::with(['homecell', 'ministry'])->paginate(10);
        return view('members.index', compact('members'));
    }

    public function create()
    {
        $homecells = Homecell::all();
        $ministries = Ministry::all();
        return view('members.create', compact('homecells', 'ministries'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'dob' => 'required|date',
            'home_of_origin' => 'nullable|string|max:255',
            'residential_home' => 'nullable|string|max:255',
            'homecell_id' => 'required|exists:homecells,id',
            'ministry_id' => 'required|exists:ministries,id',
            'picture' => 'nullable|image|max:2048',
            'marital_status' => 'nullable|string',
            'employment_status' => 'nullable|string',
            'phone' => 'nullable|string',
            'active' => 'sometimes|boolean',
            'transferred' => 'sometimes|boolean',
            'deceased' => 'sometimes|boolean'
        ]);

        if ($request->hasFile('picture')) {
            $data['picture'] = $request->file('picture')->store('members', 'public');
        }

        Member::create($data);

        return redirect()->route('members.index')->with('success', 'Member created successfully!');
    }

    public function edit(Member $member)
    {
        $homecells = Homecell::all();
        $ministries = Ministry::all();
        return view('members.edit', compact('member', 'homecells', 'ministries'));
    }

    public function update(Request $request, Member $member)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'dob' => 'required|date',
            'home_of_origin' => 'nullable|string|max:255',
            'residential_home' => 'nullable|string|max:255',
            'homecell_id' => 'required|exists:homecells,id',
            'ministry_id' => 'required|exists:ministries,id',
            'picture' => 'nullable|image|max:2048',
            'marital_status' => 'nullable|string',
            'employment_status' => 'nullable|string',
            'phone' => 'nullable|string',
            'active' => 'sometimes|boolean',
            'transferred' => 'sometimes|boolean',
            'deceased' => 'sometimes|boolean'
        ]);

        if ($request->hasFile('picture')) {
            $data['picture'] = $request->file('picture')->store('members', 'public');
        }

        $member->update($data);

        return redirect()->route('members.index')->with('success', 'Member updated successfully!');
    }

    public function destroy(Member $member)
    {
        $member->delete();
        return redirect()->route('members.index')->with('success', 'Member deleted successfully!');
    }
}
