@extends('admin.layout.admin')
@section('title', 'Dashboard')
@section('content')

<div class="container-xxl flex-grow-1 container-p-y">

    {{-- ===== WELCOME BANNER ===== --}}
    <div class="row g-4 mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm overflow-hidden"
                style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                <div class="card-body py-4">
                    <h4 class="text-white fw-bold mb-1">
                        Selamat Datang, {{ Auth::user()->name }}! 👋
                    </h4>
                    <p class="text-white-50 mb-0">
                        {{ Auth::user()->role->name ?? '-' }} &nbsp;|&nbsp;
                        {{ now()->translatedFormat('l, d F Y') }}
                    </p>
                </div>
            </div>
        </div>
    </div>

    {{-- ===== STATS CARDS ===== --}}
    @php $statColClass = Auth::user()->role_id == 1 ? 'col-xl-3 col-sm-6' : 'col-xl-6 col-sm-6'; @endphp
    <div class="row g-3 mb-4">
        <div class="{{ $statColClass }}">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <span class="text-muted fw-semibold" style="font-size:13px;">Jumlah Karyawan</span>
                        <div class="d-flex align-items-center justify-content-center rounded-3"
                            style="width:42px;height:42px;background:#E3F2FD;">
                            <i class="bx bx-group" style="font-size:22px;color:#1565C0;"></i>
                        </div>
                    </div>
                    <h4 class="fw-bold mb-0">{{ number_format($employeeCount) }}</h4>
                    <small class="text-muted">Total data karyawan</small>
                </div>
            </div>
        </div>

        @if (Auth::user()->role_id == 1)
            <div class="{{ $statColClass }}">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <span class="text-muted fw-semibold" style="font-size:13px;">Hak Akses</span>
                            <div class="d-flex align-items-center justify-content-center rounded-3"
                                style="width:42px;height:42px;background:#F3E5F5;">
                                <i class="bx bx-key" style="font-size:22px;color:#6A1B9A;"></i>
                            </div>
                        </div>
                        <h4 class="fw-bold mb-0">{{ number_format($accessCount) }}</h4>
                        <small class="text-muted">Total pengguna sistem</small>
                    </div>
                </div>
            </div>

            <div class="{{ $statColClass }}">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <span class="text-muted fw-semibold" style="font-size:13px;">Log Aktivitas</span>
                            <div class="d-flex align-items-center justify-content-center rounded-3"
                                style="width:42px;height:42px;background:#FFF3E0;">
                                <i class="bx bx-history" style="font-size:22px;color:#E65100;"></i>
                            </div>
                        </div>
                        <h4 class="fw-bold mb-0">{{ number_format($logCount) }}</h4>
                        <small class="text-muted">Total aktivitas tercatat</small>
                    </div>
                </div>
            </div>
        @endif

        <div class="{{ $statColClass }}">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <span class="text-muted fw-semibold" style="font-size:13px;">Cuaca Jakarta</span>
                        <div class="d-flex align-items-center justify-content-center rounded-3"
                            style="width:42px;height:42px;background:#E0F7FA;">
                            <i class="bx bx-cloud" style="font-size:22px;color:#00838F;"></i>
                        </div>
                    </div>
                    @if ($weather)
                        <h4 class="fw-bold mb-0">{{ $weather['temperature'] }}&deg;C</h4>
                        <small class="text-muted">
                            {{ $weather['description'] }} &bull; Angin {{ $weather['windspeed'] }} km/j
                        </small>
                    @else
                        <h4 class="fw-bold mb-0 text-muted">-</h4>
                        <small class="text-muted">Data cuaca tidak tersedia</small>
                    @endif
                </div>
            </div>
        </div>
    </div>

</div>

@include('sweetalert::alert')

@endsection
