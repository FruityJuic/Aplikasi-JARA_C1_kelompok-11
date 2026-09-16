<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\TaskList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::where('user_id', Auth::id())
            ->with('list')
            ->latest()
            ->get();

        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        $lists = TaskList::where('user_id', Auth::id())
            ->get();

        return view('tasks.create', compact('lists'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'list_id' => 'required|exists:lists,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'priority' => 'required|in:low,medium,high',
            'due_date' => 'nullable|date',
        ]);

        $validated['user_id'] = Auth::id();

        Task::create($validated);

        return redirect()
            ->route('tasks.index')
            ->with('success', 'Tugas berhasil ditambahkan.');
    }
}