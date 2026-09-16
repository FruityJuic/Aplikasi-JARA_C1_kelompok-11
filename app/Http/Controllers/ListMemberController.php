<?php

namespace App\Http\Controllers;

use App\Models\TaskList;
use App\Models\User;
use Illuminate\Http\Request;

class ListMemberController extends Controller
{
    public function index(TaskList $taskList)
    {
        $this->authorizeOwner($taskList);

        $members = $taskList->users()->get();

        $availableUsers = User::whereNotIn(
            'id',
            $members->pluck('id')
        )
        ->where('id', '!=', $taskList->owner_id)
        ->get();

        return view('lists.members', compact(
            'taskList',
            'members',
            'availableUsers'
        ));
    }

    public function store(Request $request, TaskList $taskList)
    {
        $this->authorizeOwner($taskList);

        $validated = $request->validate([
            'user_id' => [
                'required',
                'exists:users,id',
            ],
        ]);

        $taskList->users()->syncWithoutDetaching([
            $validated['user_id']
        ]);

        return back()->with(
            'success',
            'Pengguna berhasil ditambahkan ke daftar.'
        );
    }

    public function destroy(TaskList $taskList, User $user)
    {
        $this->authorizeOwner($taskList);

        $taskList->users()->detach($user->id);

        return back()->with(
            'success',
            'Pengguna berhasil dikeluarkan dari daftar.'
        );
    }

    private function authorizeOwner(TaskList $taskList): void
    {
        abort_unless(
            auth()->id() === $taskList->owner_id,
            403
        );
    }
}