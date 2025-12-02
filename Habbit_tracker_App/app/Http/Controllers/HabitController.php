<?php

namespace App\Http\Controllers;

use App\Models\Habit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HabitController extends Controller
{
    /**
     * Add authentication middleware to all methods
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the user's habits
     */
    public function index()
    {
        $habits = Habit::where('user_id', auth()->id())->get();
        return response()->json($habits);
    }
    /**
     * Store a newly created habit
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'emoji' => 'nullable|string|max:10',
            'description' => 'nullable|string',
            'streak' => 'nullable|integer',
            'completed' => 'nullable|array',
        ]);

        // Create habit with authenticated user's ID
        $habit = Habit::create([
            'user_id' => Auth::id(),
            'name' => $validated['name'],
            'emoji' => $validated['emoji'] ?? '🏃',
            'description' => $validated['description'] ?? '',
            'streak' => $validated['streak'] ?? 0,
            'completed' => $validated['completed'] ?? [false, false, false, false, false, false, false],
        ]);

        return response()->json($habit, 201);
    }

    /**
     * Update the specified habit
     */
    public function update(Request $request, Habit $habit)
    {
        // Check if user owns this habit
        if ($habit->user_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $validated = $request->validate([
            'streak' => 'nullable|integer',
            'completed' => 'nullable|array',
        ]);

        // Update only the fields that are provided
        if (isset($validated['streak'])) {
            $habit->streak = $validated['streak'];
        }

        if (isset($validated['completed'])) {
            $habit->completed = $validated['completed'];
        }

        $habit->save();

        return response()->json($habit);
    }

    /**
     * Remove the specified habit
     */
    public function destroy(Habit $habit)
    {
        // Check if user owns this habit
        if ($habit->user_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $habit->delete();

        return response()->json(['message' => 'Habit deleted successfully']);
    }
}
