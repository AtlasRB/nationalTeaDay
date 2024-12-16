<?php

namespace App\Http\Controllers;

use App\Models\Tea;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TeaController extends Controller
{
    /** Functions for tea day 1 **/
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
            'totalAverage' => Tea::where('year', 1)->avg('rating'),
            'userAverage' => Tea::where('user_id', $userId)->where('year', 1)->avg('rating'),
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
     * Remove the specified resource from storage.
     */
    public function destroy(Tea $tea)
    {
        //
        if ($tea->user_id !== auth()->id()) {
            abort(403, 'You are not authorized to delete this log.');
        }

        // Delete the log
        $tea->delete();

        return redirect()->route('dashboard')->with('success', 'Log deleted successfully.');
    }



    /** Functions for tea day 2 **/
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
            'totalAverage' => Tea::where('year', 2)->avg('rating'),
            'userAverage' => Tea::where('user_id', $userId)->where('year', 2)->avg('rating'),
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
    /**
     * Remove the specified resource from storage.
     */
    public function destroy2(Tea $tea)
    {
        //
        if ($tea->user_id !== auth()->id()) {
            abort(403, 'You are not authorized to delete this log.');
        }

        // Delete the log
        $tea->delete();

        return redirect()->route('2025')->with('success', 'Log deleted successfully.');
    }




    /** Display for welcome page **/
    public function show(): View
    {
        return view('welcome', [
            'teaCount1' => Tea::where('year', 1)->get()->count(),
            'teas1' => Tea::where('year', 1)->get(),
            'teaCount2' => Tea::where('year', 2)->get()->count(),
            'teas2' => Tea::where('year', 2)->get(),
        ]);
    }
}
