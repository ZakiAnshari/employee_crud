<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreEmployeeRequest;
use App\Http\Requests\Api\UpdateEmployeeRequest;
use App\Models\Karyawan;
use Illuminate\Http\JsonResponse;

class EmployeeController extends Controller
{
    public function index(): JsonResponse
    {
        $employees = Karyawan::latest()->paginate(10);

        return response()->json([
            'status' => true,
            'message' => 'Daftar karyawan berhasil diambil',
            'data' => $employees->items(),
            'meta' => [
                'current_page' => $employees->currentPage(),
                'per_page' => $employees->perPage(),
                'total' => $employees->total(),
                'last_page' => $employees->lastPage(),
            ],
        ]);
    }

    public function show(Karyawan $employee): JsonResponse
    {
        return response()->json([
            'status' => true,
            'message' => 'Detail karyawan berhasil diambil',
            'data' => $employee,
        ]);
    }

    public function store(StoreEmployeeRequest $request): JsonResponse
    {
        $employee = Karyawan::create($request->validated());

        return response()->json([
            'status' => true,
            'message' => 'Karyawan berhasil ditambahkan',
            'data' => $employee,
        ], 201);
    }

    public function update(UpdateEmployeeRequest $request, Karyawan $employee): JsonResponse
    {
        $employee->update($request->validated());

        return response()->json([
            'status' => true,
            'message' => 'Karyawan berhasil diperbarui',
            'data' => $employee,
        ]);
    }

    public function destroy(Karyawan $employee): JsonResponse
    {
        $employee->delete();

        return response()->json([
            'status' => true,
            'message' => 'Karyawan berhasil dihapus',
        ]);
    }
}
