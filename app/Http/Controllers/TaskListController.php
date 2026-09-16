<?php

namespace App\Http\Controllers;

use App\Models\TaskList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskListController extends Controller
{
    /**
     * Menampilkan semua list milik user.
     */
    public function index()
    {
        $lists = TaskList::where('user_id', auth::id())
            ->withCount('tasks')
            ->latest()
            ->get();

        return view('task-lists.index', compact('lists'));
    }

    /**
     * Menampilkan form membuat list.
     */
    public function create()
    {
        return view('task-lists.create');
    }

    /**
     * Menyimpan list baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
        ]);

        TaskList::create([
            'name' => $validated['name'],
            'description' => $validated['description'] ?? null,
            'user_id' => auth::id(),
        ]);

        return redirect()
            ->route('task-lists.index')
            ->with('success', 'List berhasil dibuat.');
    }

    /**
     * Menghapus list.
     */
    public function destroy(TaskList $taskList)
    {
        // Pastikan hanya pemilik list yang bisa menghapus.
        abort_if($taskList->user_id !== auth::id(), 403);

        $taskList->delete();

        return redirect()
            ->route('task-lists.index')
            ->with('success', 'List berhasil dihapus.');
    }
}