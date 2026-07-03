@extends('admin.layout.admin')
@section('title', 'Detail Karyawan')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">

        <div class="card">
            <div class="d-flex align-items-center border-bottom pb-2 mb-3">
                <a class="mx-4 my-4" href="{{ route('karyawan.index') }}">
                    <button class="btn btn-outline-primary border-1 rounded-1 px-3 py-1 d-flex align-items-center"
                        data-bs-toggle="tooltip" title="Kembali">
                        <i class="bi bi-arrow-left fs-5 mx-1"></i>
                    </button>
                </a>
                <h4 class="fw-bold d-flex align-items-center my-4">
                    <span class="text-muted fw-light me-1"></span> Detail Karyawan
                    <i class="bx bx-group mx-2 text-primary" style="font-size: 1.5rem;"></i>
                </h4>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-lg-3 text-center mb-4">
                        <img src="{{ $karyawan->photo ? asset('storage/' . $karyawan->photo) : asset('backend/assets/img/avatars/1.png') }}"
                            class="rounded" width="160" height="160" style="object-fit:cover;">
                    </div>

                    <div class="col-lg-9">
                        <table class="table table-borderless">
                            <tr>
                                <th style="width: 220px;">Employee ID</th>
                                <td>: {{ $karyawan->employee_id }}</td>
                            </tr>
                            <tr>
                                <th>Nama Karyawan</th>
                                <td>: {{ $karyawan->name }}</td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td>: {{ $karyawan->email }}</td>
                            </tr>
                            <tr>
                                <th>Nomor Telepon</th>
                                <td>: {{ $karyawan->phone }}</td>
                            </tr>
                            <tr>
                                <th>Departemen</th>
                                <td>: {{ $karyawan->department }}</td>
                            </tr>
                            <tr>
                                <th>Tanggal Bergabung</th>
                                <td>: {{ $karyawan->join_date->format('d-m-Y') }}</td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td>:
                                    @if ($karyawan->is_active)
                                        <span class="badge bg-success">Aktif</span>
                                    @else
                                        <span class="badge bg-secondary">Nonaktif</span>
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('sweetalert::alert')
@endsection
