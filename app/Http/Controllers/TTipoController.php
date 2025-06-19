<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TTipoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('ttipo.index');

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('ttipo.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
        ]);
        // Create a new TTipo instance and save it
        $ttipo = new \App\Models\TTipo();
        $ttipo->name = $request->input('name');
        $ttipo->description = $request->input('description');
        $ttipo->save();
        // Redirect to the index page with a success message
        return redirect()->route('ttipo.index')->with('success', 'TTipo created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $ttipo = \App\Models\TTipo::findOrFail($id);
        return view('ttipo.show', compact('ttipo'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $ttipo = \App\Models\TTipo::findOrFail($id);
        return view('ttipo.edit', compact('ttipo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
        ]);
        $ttipo = \App\Models\TTipo::findOrFail($id);
        $ttipo->name = $request->input('name');
        $ttipo->description = $request->input('description');
        $ttipo->save();
        return redirect()->route('ttipo.index')->with('success', 'TTipo updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $ttipo = \App\Models\TTipo::findOrFail($id);
        $ttipo->delete();
        return redirect()->route('ttipo.index')->with('success', 'TTipo deleted successfully.');
    }
}
