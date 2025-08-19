<?php

namespace App\Http\Controllers;

use App\Models\Ministry;
use Illuminate\Http\Request;

class MinistryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $ministries = Ministry::latest()->paginate(12);

        return view('ministries.index', compact('ministries'));
    }

    public function create()
    {
        return view('ministries.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Ministry::create($data);

        return redirect()->route('ministries.index')->with('success', 'Ministry created successfully.');
    }

    public function edit(Ministry $ministry)
    {
        return view('ministries.edit', compact('ministry'));
    }

    public function update(Request $request, Ministry $ministry)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $ministry->update($data);

        return redirect()->route('ministries.index')->with('success', 'Ministry updated successfully.');
    }

    public function destroy(Ministry $ministry)
    {
        $ministry->delete();

        return redirect()->route('ministries.index')->with('success', 'Ministry deleted successfully.');
    }
}
