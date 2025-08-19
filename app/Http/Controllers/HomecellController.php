<?php

namespace App\Http\Controllers;

use App\Models\Homecell;
use Illuminate\Http\Request;

class HomecellController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // All users see all homecells
        $homecells = Homecell::latest()->paginate(12);

        return view('homecells.index', compact('homecells'));
    }

    public function create()
    {
        return view('homecells.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Homecell::create($data);

        return redirect()->route('homecells.index')->with('success', 'Homecell created successfully.');
    }

    public function edit(Homecell $homecell)
    {
        return view('homecells.edit', compact('homecell'));
    }

    public function update(Request $request, Homecell $homecell)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $homecell->update($data);

        return redirect()->route('homecells.index')->with('success', 'Homecell updated successfully.');
    }

    public function destroy(Homecell $homecell)
    {
        $homecell->delete();

        return redirect()->route('homecells.index')->with('success', 'Homecell deleted successfully.');
    }
}
