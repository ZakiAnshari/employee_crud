@extends('admin.layout.admin')
@section('title', 'Dashboard')
@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row g-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm overflow-hidden"
                style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                <div class="card-body py-5 text-center">
                    <h4 class="text-white fw-bold mb-0">
                        Selamat Datang, {{ Auth::user()->name }}! 👋
                    </h4>
                </div>
            </div>
        </div>
    </div>
</div>

@include('sweetalert::alert')

@endsection
