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
    public function index(Request $request): View
    {
        //
        $routeName = $request->route()->getName();
        $userId = $request->user()->id;

        if ($routeName === 'dashboard.filteredC') {
            // Filter for user_id = 1
            $teas = Tea::where('user_id', 1)->where('year', 1)->get();
        } elseif ($routeName === 'dashboard.filteredH') {
            // Example filter: Teas with rating >= 8
            $teas = Tea::where('user_id', 2)->where('year', 1)->get();
        } else {
            // Default case: All teas
            $teas = Tea::where('year', 1)->get();
        }

        // Shared data
        return view('dashboard', [
            'teaCount' => Tea::where('year', 1)->get()->count(),
            'userCount' => Tea::where('user_id', $userId)->where('year', 1)->count(),
            'teas' => $teas,
        ]);
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

        $validated['year'] = 1;

        $request->user()->teas()->create($validated);

        return redirect(route('dashboard'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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


    /** Functions for next year **/
    public function index2(Request $request): View
    {
        //
        $routeName = $request->route()->getName();
        $userId = $request->user()->id;

        if ($routeName === '2025.filteredC') {
            // Filter for user_id = 1
            $teas = Tea::where('user_id', 1)->where('year', 2)->get();
        } elseif ($routeName === '2025.filteredH') {
            // Example filter: Teas with rating >= 8
            $teas = Tea::where('user_id', 2)->where('year', 2)->get();
        } else {
            // Default case: All teas
            $teas = Tea::where('year', 2)->get();
        }

        // Shared data
        return view('2025', [
            'teaCount' => Tea::where('year', 2)->get()->count(),
            'userCount' => Tea::where('user_id', $userId)->where('year', 2)->count(),
            'teas' => $teas,
        ]);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store2(Request $request): RedirectResponse
    {
        //
        $validated = $request->validate([
            'message' => 'required|string|max:255',
            'rating' => 'required|integer|between:1,10',
        ]);

        $validated['year'] = 2;

        $request->user()->teas()->create($validated);

        return redirect(route('2025'));
    }
}
