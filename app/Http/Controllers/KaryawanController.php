<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KaryawanController extends Controller
{
    public function index()
    {
        $karyawans = Karyawan::latest()->get();

        return view('admin.karyawan.index', compact('karyawans'));
    }

    public function show(int $id)
    {
        $karyawan = Karyawan::findOrFail($id);

        return view('admin.karyawan.show', compact('karyawan'));
    }

    public function store(Request $request)
    {
        $validated = $this->validateKaryawan($request);

        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('karyawan', 'public');
        }

        $karyawan = Karyawan::create($validated);

        ActivityLog::record('create', "Menambahkan karyawan \"{$karyawan->name}\" ({$karyawan->employee_id})");

        alert()->success('Berhasil', 'Data karyawan berhasil ditambahkan');
        return redirect()->route('karyawan.index');
    }

    public function edit(int $id)
    {
        return redirect()->route('karyawan.index');
    }

    public function update(Request $request, int $id)
    {
        $karyawan = Karyawan::findOrFail($id);
        $original = $karyawan->getOriginal();

        $validated = $this->validateKaryawan($request, $karyawan);

        if ($request->hasFile('photo')) {
            if ($karyawan->photo) {
                Storage::disk('public')->delete($karyawan->photo);
            }
            $validated['photo'] = $request->file('photo')->store('karyawan', 'public');
        }

        $karyawan->update($validated);

        $changes = $karyawan->getChanges();
        if (array_key_exists('is_active', $changes)) {
            $original['is_active'] = $original['is_active'] ? 'Aktif' : 'Tidak Aktif';
            $changes['is_active'] = $changes['is_active'] ? 'Aktif' : 'Tidak Aktif';
        }
        if (array_key_exists('gender', $changes)) {
            $original['gender'] = $original['gender'] === 'P' ? 'Perempuan' : 'Laki-laki';
            $changes['gender'] = $changes['gender'] === 'P' ? 'Perempuan' : 'Laki-laki';
        }

        $detail = ActivityLog::describeChanges($original, $changes, [
            'employee_id' => 'ID Karyawan',
            'name' => 'Nama',
            'gender' => 'Jenis Kelamin',
            'email' => 'Email',
            'phone' => 'Telepon',
            'department' => 'Departemen',
            'join_date' => 'Tanggal Bergabung',
            'is_active' => 'Status',
            'photo' => 'Foto',
        ], sensitive: ['photo']);

        ActivityLog::record('update', "Memperbarui karyawan \"{$karyawan->name}\" ({$karyawan->employee_id}) — {$detail}");

        alert()->success('Berhasil', 'Data karyawan berhasil diperbarui');
        return redirect()->route('karyawan.index');
    }

    public function destroy(int $id)
    {
        $karyawan = Karyawan::findOrFail($id);

        if ($karyawan->photo) {
            Storage::disk('public')->delete($karyawan->photo);
        }

        $karyawan->delete();

        ActivityLog::record('delete', "Menghapus karyawan \"{$karyawan->name}\" ({$karyawan->employee_id})");

        alert()->success('Berhasil', 'Data karyawan berhasil dihapus');
        return redirect()->route('karyawan.index');
    }

    private function validateKaryawan(Request $request, ?Karyawan $karyawan = null): array
    {
        return $request->validate([
            'employee_id' => 'required|string|max:50|unique:karyawans,employee_id,' . ($karyawan->id ?? 'NULL'),
            'name' => 'required|string|max:150',
            'gender' => 'required|in:L,P',
            'email' => 'required|email|max:150|unique:karyawans,email,' . ($karyawan->id ?? 'NULL'),
            'phone' => 'required|string|max:20',
            'department' => 'required|string|max:100',
            'join_date' => 'required|date',
            'is_active' => 'required|boolean',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);
    }
}
