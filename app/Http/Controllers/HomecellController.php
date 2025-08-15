<?php

namespace App\Http\Controllers;

use App\Models\Homecell;
use Illuminate\Http\Request;

class HomecellController extends Controller
{
    public function index()
    {
        $homecells = Homecell::latest()->paginate(10);
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
            'leader' => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ]);

        Homecell::create($data);

        return redirect()->route('homecells.index')->with('success', 'Homecell added successfully.');
    }

    public function edit(Homecell $homecell)
    {
        return view('homecells.edit', compact('homecell'));
    }

    public function update(Request $request, Homecell $homecell)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'leader' => 'nullable|string|max:255',
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
