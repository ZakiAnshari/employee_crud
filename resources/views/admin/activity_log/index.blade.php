@extends('admin.layout.admin')
@section('title', 'Log Aktivitas')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <h4 class="fw-bold d-flex align-items-center my-4">
                <i class="bx bx-history me-2 text-primary" style="font-size: 1.5rem;"></i>
                <span class="text-muted fw-light me-1"></span> Log Aktivitas
            </h4>

            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive text-nowrap">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 5px;">No</th>
                                        <th>Waktu</th>
                                        <th>Admin</th>
                                        <th>Aksi</th>
                                        <th>Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($logs as $log)
                                        <tr>
                                            <td>{{ $loop->iteration + ($logs->currentPage() - 1) * $logs->perPage() }}</td>
                                            <td>{{ $log->created_at->format('d-m-Y H:i') }}</td>
                                            <td>{{ $log->user->name ?? '-' }}</td>
                                            <td>
                                                @if ($log->action === 'create')
                                                    <span class="badge bg-success">Tambah</span>
                                                @elseif ($log->action === 'update')
                                                    <span class="badge bg-warning text-dark">Edit</span>
                                                @elseif ($log->action === 'delete')
                                                    <span class="badge bg-danger">Hapus</span>
                                                @elseif ($log->action === 'login')
                                                    <span class="badge bg-info text-dark">Login</span>
                                                @elseif ($log->action === 'logout')
                                                    <span class="badge bg-secondary">Logout</span>
                                                @else
                                                    <span class="badge bg-secondary">{{ ucfirst($log->action) }}</span>
                                                @endif
                                            </td>
                                            <td>{{ $log->description }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center text-muted">Belum ada aktivitas</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>

                            <div class="mt-3">
                                {{ $logs->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('sweetalert::alert')
@endsection
