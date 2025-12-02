<?php

namespace App\Http\Controllers;

use App\Models\Habit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

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
        Log::info('Habit store payload', $request->all());

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'emoji' => 'nullable|string|max:10',
            'description' => 'nullable|string',
            'streak' => 'nullable|integer',
            'completed' => 'nullable|array',
        ]);

        // Create habit with authenticated user's ID
        try {
            $habit = Habit::create([
                'user_id' => Auth::id(),
                'name' => $validated['name'],
                'emoji' => $validated['emoji'] ?? '🏃',
                'description' => $validated['description'] ?? '',
                'streak' => $validated['streak'] ?? 0,
                'completed' => $validated['completed'] ?? [false, false, false, false, false, false, false],
            ]);

            return response()->json($habit, 201);
        } catch (\Exception $e) {
            Log::error('Failed creating habit', ['message' => $e->getMessage(), 'payload' => $request->all()]);
            return response()->json(['error' => 'Failed to create habit'], 500);
        }
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

        Log::info('Habit update request', [
            'habit_id' => $habit->id,
            'request_all' => $request->all(),
            'content_type' => $request->header('Content-Type')
        ]);

        $validated = $request->validate([
            'streak' => 'nullable|integer',
            'completed' => 'nullable|array',
        ]);

        try {
            // Update only the fields that are provided
            if (isset($validated['streak'])) {
                $habit->streak = $validated['streak'];
            }

            if (isset($validated['completed'])) {
                $habit->completed = $validated['completed'];
            }

            $habit->save();

            Log::info('Habit updated successfully', ['habit' => $habit->toArray()]);
            return response()->json($habit);
        } catch (\Exception $e) {
            Log::error('Failed updating habit', ['message' => $e->getMessage(), 'habit_id' => $habit->id]);
            return response()->json(['error' => 'Failed to update habit'], 500);
        }
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
