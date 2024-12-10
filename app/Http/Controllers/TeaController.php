<?php

namespace App\Http\Controllers;

use App\Models\Tea;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TeaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        //
        return view('dashboard', [
            'teaCount' => Tea::all()->count(),
            'user' => auth()->user(),
            'teas' => Tea::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        //
        $validated = $request->validate([
            'message' => 'required|string|max:255',
            'rating' => 'required|integer|between:1,10',
        ]);

        $request->user()->teas()->create($validated);

        return redirect(route('dashboard'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Tea $tea)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tea $tea)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tea $tea)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tea $tea)
    {
        //
    }
}
