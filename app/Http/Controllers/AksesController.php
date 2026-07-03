<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AksesController extends Controller
{
    public function index()
    {
        $users = User::latest()->get();

        return view('admin.akses.index', compact('users'));
    }

    public function store(Request $request)
    {
        $validated = $this->validateAkses($request);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'role_id' => $validated['role'] === 'admin' ? 1 : 2,
            'password' => Hash::make($validated['password']),
        ]);

        ActivityLog::record('create', "Menambahkan akses pengguna \"{$user->name}\" ({$user->email})");

        alert()->success('Berhasil', 'Akses pengguna berhasil ditambahkan');
        return redirect()->route('akses.index');
    }

    public function edit(int $id)
    {
        return redirect()->route('akses.index');
    }

    public function update(Request $request, int $id)
    {
        $user = User::findOrFail($id);
        $original = $user->getOriginal();

        $validated = $this->validateAkses($request, $user);

        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->role_id = $validated['role'] === 'admin' ? 1 : 2;

        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        $changes = $user->getChanges();
        if (array_key_exists('role_id', $changes)) {
            $original['role_id'] = $original['role_id'] == 1 ? 'Admin' : 'User';
            $changes['role_id'] = $changes['role_id'] == 1 ? 'Admin' : 'User';
        }

        $detail = ActivityLog::describeChanges($original, $changes, [
            'name' => 'Nama',
            'email' => 'Email',
            'role_id' => 'Role',
            'password' => 'Password',
        ], sensitive: ['password']);

        ActivityLog::record('update', "Memperbarui akses pengguna \"{$user->name}\" ({$user->email}) — {$detail}");

        alert()->success('Berhasil', 'Akses pengguna berhasil diperbarui');
        return redirect()->route('akses.index');
    }

    public function destroy(int $id)
    {
        $user = User::findOrFail($id);

        if ($user->id === auth()->id()) {
            alert()->error('Gagal', 'Tidak bisa menghapus akun yang sedang login');
            return redirect()->route('akses.index');
        }

        $user->delete();

        ActivityLog::record('delete', "Menghapus akses pengguna \"{$user->name}\" ({$user->email})");

        alert()->success('Berhasil', 'Akses pengguna berhasil dihapus');
        return redirect()->route('akses.index');
    }

    private function validateAkses(Request $request, ?User $user = null): array
    {
        return $request->validate([
            'name' => 'required|string|max:150',
            'email' => 'required|email|max:150|unique:users,email,' . ($user->id ?? 'NULL'),
            'role' => 'required|in:admin,user',
            'password' => ($user ? 'nullable' : 'required') . '|string|min:6',
        ]);
    }
}
