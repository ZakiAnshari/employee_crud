@extends('admin.layout.admin')
@section('title', 'Manajemen Karyawan')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <h4 class="fw-bold d-flex align-items-center my-4">
                <i class="bx bx-group me-2 text-primary" style="font-size: 1.5rem;"></i>
                <span class="text-muted fw-light me-1"></span> Manajemen Karyawan
            </h4>

            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive text-nowrap">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            @if (Auth::user()->role_id == 1)
                                <div class="d-flex justify-content-end align-items-center mb-3 flex-wrap gap-2">
                                    <button type="button"
                                        class="btn btn-outline-success account-image-reset d-flex align-items-center"
                                        data-bs-toggle="modal" data-bs-target="#addKaryawanModal">
                                        <i class="bx bx-plus me-2 d-block"></i>
                                        <span>Tambah Karyawan</span>
                                    </button>
                                </div>
                            @endif

                            <!-- Modal Tambah Karyawan -->
                            @if (Auth::user()->role_id == 1)
                            <div class="modal fade" id="addKaryawanModal" tabindex="-1"
                                aria-labelledby="addKaryawanModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="addKaryawanModalLabel">Tambah Karyawan</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <form action="{{ route('karyawan.store') }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label class="form-label fw-semibold">Employee ID</label>
                                                            <input type="text" name="employee_id"
                                                                class="form-control @error('employee_id') is-invalid @enderror"
                                                                value="{{ old('employee_id') }}" placeholder="EMP-0001">
                                                            @error('employee_id')
                                                                <small class="text-danger">{{ $message }}</small>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label class="form-label fw-semibold">Nama Karyawan</label>
                                                            <input type="text" name="name"
                                                                class="form-control @error('name') is-invalid @enderror"
                                                                value="{{ old('name') }}">
                                                            @error('name')
                                                                <small class="text-danger">{{ $message }}</small>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label class="form-label fw-semibold">Email</label>
                                                            <input type="email" name="email"
                                                                class="form-control @error('email') is-invalid @enderror"
                                                                value="{{ old('email') }}">
                                                            @error('email')
                                                                <small class="text-danger">{{ $message }}</small>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label class="form-label fw-semibold">Nomor Telepon</label>
                                                            <input type="text" name="phone"
                                                                class="form-control @error('phone') is-invalid @enderror"
                                                                value="{{ old('phone') }}">
                                                            @error('phone')
                                                                <small class="text-danger">{{ $message }}</small>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label class="form-label fw-semibold">Departemen</label>
                                                            <input type="text" name="department"
                                                                class="form-control @error('department') is-invalid @enderror"
                                                                value="{{ old('department') }}"
                                                                placeholder="cth: Finance, HR, IT">
                                                            @error('department')
                                                                <small class="text-danger">{{ $message }}</small>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label class="form-label fw-semibold">Tanggal
                                                                Bergabung</label>
                                                            <input type="date" name="join_date"
                                                                class="form-control @error('join_date') is-invalid @enderror"
                                                                value="{{ old('join_date') }}">
                                                            @error('join_date')
                                                                <small class="text-danger">{{ $message }}</small>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label class="form-label fw-semibold">Status Aktif</label>
                                                            <select name="is_active"
                                                                class="form-control @error('is_active') is-invalid @enderror">
                                                                <option value="1"
                                                                    {{ old('is_active', 1) == 1 ? 'selected' : '' }}>
                                                                    Aktif</option>
                                                                <option value="0"
                                                                    {{ old('is_active', 1) == 0 ? 'selected' : '' }}>
                                                                    Nonaktif</option>
                                                            </select>
                                                            @error('is_active')
                                                                <small class="text-danger">{{ $message }}</small>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label class="form-label fw-semibold">Foto Karyawan</label>
                                                            <input type="file" name="photo"
                                                                class="form-control @error('photo') is-invalid @enderror"
                                                                accept="image/png, image/jpeg, image/jpg">
                                                            @error('photo')
                                                                <small class="text-danger">{{ $message }}</small>
                                                            @enderror
                                                            <small class="text-muted d-block mt-1">
                                                                • Maksimal ukuran file <strong>2MB</strong><br>
                                                                • Format diperbolehkan: <strong>JPG, JPEG,
                                                                    PNG</strong>
                                                            </small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @endif

                            <!-- Table Data -->
                            <table id="karyawanTable" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 5px;">No</th>
                                        <th>Foto</th>
                                        <th>Employee ID</th>
                                        <th>Nama Karyawan</th>
                                        <th>Departemen</th>
                                        <th>Status</th>
                                        <th style="width: 130px; text-align: center;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($karyawans as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <img src="{{ $item->photo ? asset('storage/' . $item->photo) : asset('backend/assets/img/avatars/1.png') }}"
                                                    class="rounded-circle" width="36" height="36"
                                                    style="object-fit:cover;">
                                            </td>
                                            <td>{{ $item->employee_id }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->department }}</td>
                                            <td>
                                                @if ($item->is_active)
                                                    <span class="badge bg-success">Aktif</span>
                                                @else
                                                    <span class="badge bg-secondary">Nonaktif</span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <a href="{{ route('karyawan.show', $item->id) }}"
                                                    class="btn btn-icon btn-outline-info" title="Detail">
                                                    <i class="bx bx-show"></i>
                                                </a>
                                                @if (Auth::user()->role_id == 1)
                                                    <button type="button" class="btn btn-icon btn-outline-primary"
                                                        title="Edit" data-bs-toggle="modal"
                                                        data-bs-target="#editKaryawanModal{{ $item->id }}">
                                                        <i class="bx bx-edit-alt"></i>
                                                    </button>
                                                    <button class="btn btn-icon btn-outline-danger" title="Hapus"
                                                        onclick="confirmDeleteKaryawan('{{ $item->id }}', '{{ $item->name }}')">
                                                        <i class="bx bx-trash"></i>
                                                    </button>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center text-muted">Belum ada data karyawan</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>

                            {{-- DataTable initialization handled globally in layout.admin via .datatable class --}}

                            <!-- Modal Edit Karyawan (per baris) -->
                            @if (Auth::user()->role_id == 1)
                            @foreach ($karyawans as $item)
                                <div class="modal fade" id="editKaryawanModal{{ $item->id }}" tabindex="-1"
                                    aria-labelledby="editKaryawanModalLabel{{ $item->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editKaryawanModalLabel{{ $item->id }}">
                                                    Edit Karyawan - {{ $item->name }}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('karyawan.update', $item->id) }}" method="POST"
                                                enctype="multipart/form-data">
                                                @csrf
                                                @method('POST')
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label class="form-label fw-semibold">Employee
                                                                    ID</label>
                                                                <input type="text" name="employee_id"
                                                                    class="form-control"
                                                                    value="{{ $item->employee_id }}"
                                                                    placeholder="EMP-0001">
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label class="form-label fw-semibold">Nama
                                                                    Karyawan</label>
                                                                <input type="text" name="name" class="form-control"
                                                                    value="{{ $item->name }}">
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label class="form-label fw-semibold">Email</label>
                                                                <input type="email" name="email" class="form-control"
                                                                    value="{{ $item->email }}">
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label class="form-label fw-semibold">Nomor
                                                                    Telepon</label>
                                                                <input type="text" name="phone" class="form-control"
                                                                    value="{{ $item->phone }}">
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label class="form-label fw-semibold">Departemen</label>
                                                                <input type="text" name="department"
                                                                    class="form-control" value="{{ $item->department }}"
                                                                    placeholder="cth: Finance, HR, IT">
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label class="form-label fw-semibold">Tanggal
                                                                    Bergabung</label>
                                                                <input type="date" name="join_date"
                                                                    class="form-control"
                                                                    value="{{ $item->join_date->format('Y-m-d') }}">
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label class="form-label fw-semibold">Status
                                                                    Aktif</label>
                                                                <select name="is_active" class="form-control">
                                                                    <option value="1"
                                                                        {{ $item->is_active ? 'selected' : '' }}>
                                                                        Aktif</option>
                                                                    <option value="0"
                                                                        {{ !$item->is_active ? 'selected' : '' }}>
                                                                        Nonaktif</option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label class="form-label fw-semibold">Foto
                                                                    Karyawan</label>
                                                                <input type="file" name="photo" class="form-control"
                                                                    accept="image/png, image/jpeg, image/jpg">
                                                                @if ($item->photo)
                                                                    <div class="mt-2">
                                                                        <img src="{{ asset('storage/' . $item->photo) }}"
                                                                            class="rounded border" width="80"
                                                                            height="80" style="object-fit:cover;">
                                                                    </div>
                                                                @endif
                                                                <small class="text-muted d-block mt-1">
                                                                    • Maksimal ukuran file <strong>2MB</strong><br>
                                                                    • Format diperbolehkan: <strong>JPG, JPEG,
                                                                        PNG</strong>
                                                                </small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Update</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function confirmDeleteKaryawan(id, name) {
            Swal.fire({
                title: 'Yakin ingin menghapus?',
                text: `"${name}" akan dihapus secara permanen!`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = `/karyawan-destroy/${id}`;
                }
            });
        }
    </script>
    <script>
        $(document).ready(function() {
            $('#karyawanTable').DataTable({
                paging: true,
                searching: true,
                ordering: true,
                info: true,
                responsive: true,
                autoWidth: false,
            });
        });
    </script>

    @include('sweetalert::alert')
@endsection
