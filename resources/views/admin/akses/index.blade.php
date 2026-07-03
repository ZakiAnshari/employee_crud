@extends('admin.layout.admin')
@section('title', 'Manajemen Akses')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <h4 class="fw-bold d-flex align-items-center my-4">
                <i class="bx bx-key me-2 text-primary" style="font-size: 1.5rem;"></i>
                <span class="text-muted fw-light me-1"></span> Manajemen Akses
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

                            <div class="d-flex justify-content-end align-items-center mb-3 flex-wrap gap-2">
                                <button type="button"
                                    class="btn btn-outline-success account-image-reset d-flex align-items-center"
                                    data-bs-toggle="modal" data-bs-target="#addAksesModal">
                                    <i class="bx bx-plus me-2 d-block"></i>
                                    <span>Tambah Akses</span>
                                </button>
                            </div>

                            <!-- Modal Tambah Akses -->
                            <div class="modal fade" id="addAksesModal" tabindex="-1"
                                aria-labelledby="addAksesModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="addAksesModalLabel">Tambah Akses</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <form action="{{ route('akses.store') }}" method="POST">
                                            @csrf
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label class="form-label fw-semibold">Nama</label>
                                                    <input type="text" name="name"
                                                        class="form-control @error('name') is-invalid @enderror"
                                                        value="{{ old('name') }}">
                                                    @error('name')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label fw-semibold">Email</label>
                                                    <input type="email" name="email"
                                                        class="form-control @error('email') is-invalid @enderror"
                                                        value="{{ old('email') }}">
                                                    @error('email')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label fw-semibold">Hak Akses</label>
                                                    <select name="role"
                                                        class="form-control @error('role') is-invalid @enderror">
                                                        <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>
                                                            Admin</option>
                                                        <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>
                                                            User</option>
                                                    </select>
                                                    @error('role')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label fw-semibold">Password</label>
                                                    <input type="password" name="password"
                                                        class="form-control @error('password') is-invalid @enderror">
                                                    @error('password')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
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

                            <!-- Table Data -->
                            <table id="aksesTable" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 5px;">No</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Hak Akses</th>
                                        <th style="width: 100px; text-align: center;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($users as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->email }}</td>
                                            <td>
                                                @if ($item->role_id == 1)
                                                    <span class="badge bg-primary">Admin</span>
                                                @else
                                                    <span class="badge bg-secondary">User</span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <button type="button" class="btn btn-icon btn-outline-primary"
                                                    title="Edit" data-bs-toggle="modal"
                                                    data-bs-target="#editAksesModal{{ $item->id }}">
                                                    <i class="bx bx-edit-alt"></i>
                                                </button>
                                                @if ($item->id !== auth()->id())
                                                    <button class="btn btn-icon btn-outline-danger" title="Hapus"
                                                        onclick="confirmDeleteAkses('{{ $item->id }}', '{{ $item->name }}')">
                                                        <i class="bx bx-trash"></i>
                                                    </button>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center text-muted">Belum ada data akses</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>

                            <!-- Modal Edit Akses (per baris) -->
                            @foreach ($users as $item)
                                <div class="modal fade" id="editAksesModal{{ $item->id }}" tabindex="-1"
                                    aria-labelledby="editAksesModalLabel{{ $item->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editAksesModalLabel{{ $item->id }}">
                                                    Edit Akses - {{ $item->name }}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('akses.update', $item->id) }}" method="POST">
                                                @csrf
                                                @method('POST')
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label class="form-label fw-semibold">Nama</label>
                                                        <input type="text" name="name" class="form-control"
                                                            value="{{ $item->name }}">
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="form-label fw-semibold">Email</label>
                                                        <input type="email" name="email" class="form-control"
                                                            value="{{ $item->email }}">
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="form-label fw-semibold">Hak Akses</label>
                                                        <select name="role" class="form-control">
                                                            <option value="admin"
                                                                {{ $item->role_id == 1 ? 'selected' : '' }}>Admin
                                                            </option>
                                                            <option value="user"
                                                                {{ $item->role_id == 2 ? 'selected' : '' }}>User
                                                            </option>
                                                        </select>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="form-label fw-semibold">Password</label>
                                                        <input type="password" name="password" class="form-control"
                                                            placeholder="Kosongkan jika tidak ingin mengubah">
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

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function confirmDeleteAkses(id, name) {
            Swal.fire({
                title: 'Yakin ingin menghapus?',
                text: `Akses "${name}" akan dihapus secara permanen!`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = `/akses-destroy/${id}`;
                }
            });
        }
    </script>
    <script>
        $(document).ready(function() {
            $('#aksesTable').DataTable({
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
