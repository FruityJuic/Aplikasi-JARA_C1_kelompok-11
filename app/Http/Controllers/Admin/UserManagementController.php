<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserManagementController extends Controller
{
    public function index()
    {
        abort_unless(
            auth()->user()->isAdmin(),
            403
        );

        $users = User::orderBy('name')->get();

        return view(
            'admin.users.index',
            compact('users')
        );
    }

    public function create()
    {
        abort_unless(
            auth()->user()->isAdmin(),
            403
        );

        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        abort_unless(
            auth()->user()->isAdmin(),
            403
        );

        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'email' => [
                'required',
                'email',
                'unique:users,email',
            ],

            'password' => [
                'required',
                'min:8',
                'confirmed',
            ],

            'role' => [
                'required',
                'in:admin,user',
            ],
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make(
                $validated['password']
            ),
            'role' => $validated['role'],
        ]);

        return redirect()
            ->route('admin.users.index')
            ->with(
                'success',
                'Akun berhasil dibuat.'
            );
    }
    
    public function destroy(User $user)
    {
        abort_unless(
            auth()->user()->isAdmin(),
            403
        );

        if ($user->id === auth()->id()) {
            return back()->with(
                'error',
                'Admin tidak dapat menghapus akunnya sendiri.'
            );
        }

        $user->delete();

        return back()->with(
            'success',
            'Akun berhasil dihapus.'
        );
    }
}