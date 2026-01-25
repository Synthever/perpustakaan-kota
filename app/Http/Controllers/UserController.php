<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('anggota')->orderBy('id_user', 'desc')->paginate(10);
        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|unique:user,username',
            'password' => 'required|min:6',
            'role' => 'required|in:admin,staff,staff_stock',
        ]);

        User::create([
            'username' => $validated['username'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'],
            'id_anggota' => null,
        ]);

        return redirect(roleRoute('users.index'))->with('success', 'User berhasil ditambahkan');
    }

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'username' => 'required|unique:user,username,' . $user->id_user . ',id_user',
            'role' => 'required|in:admin,staff,staff_stock,anggota',
        ]);

        $data = [
            'username' => $validated['username'],
            'role' => $validated['role'],
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect(roleRoute('users.index'))->with('success', 'User berhasil diupdate');
    }

    public function destroy(User $user)
    {
        // Tidak bisa hapus diri sendiri
        if ($user->id_user === auth()->user()->id_user) {
            return back()->withErrors(['error' => 'Tidak dapat menghapus user yang sedang login']);
        }

        $user->delete();
        return redirect(roleRoute('users.index'))->with('success', 'User berhasil dihapus');
    }
}
