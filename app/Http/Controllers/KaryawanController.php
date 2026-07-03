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

        $validated = $this->validateKaryawan($request, $karyawan);

        if ($request->hasFile('photo')) {
            if ($karyawan->photo) {
                Storage::disk('public')->delete($karyawan->photo);
            }
            $validated['photo'] = $request->file('photo')->store('karyawan', 'public');
        }

        $karyawan->update($validated);

        ActivityLog::record('update', "Memperbarui karyawan \"{$karyawan->name}\" ({$karyawan->employee_id})");

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
            'email' => 'required|email|max:150|unique:karyawans,email,' . ($karyawan->id ?? 'NULL'),
            'phone' => 'required|string|max:20',
            'department' => 'required|string|max:100',
            'join_date' => 'required|date',
            'is_active' => 'required|boolean',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);
    }
}
