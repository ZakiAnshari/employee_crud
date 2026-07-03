<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default"
    data-assets-path="../assets/" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>@yield('title') | Employee Management System</title>
    <meta name="description" content="" />
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('/backend/assets/img/favicon/favicon.ico') }}" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <!-- Fonts -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@1.5.2/dist/select2-bootstrap4.min.css"
        rel="stylesheet" />

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet">
    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="{{ asset('/backend/assets/vendor/fonts/boxicons.css') }}" />
    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('/backend/assets/vendor/css/core.css') }}"
        class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('/backend/assets/vendor/css/theme-default.css') }}"
        class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('/backend/assets/css/demo.css') }}" />
    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('/backend/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
    <link rel="stylesheet" href="{{ asset('/backend/assets/vendor/libs/apex-charts/apex-charts.css') }}" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    {{-- TEXT AREA --}}


    <!-- Helpers -->
    <script src="{{ asset('/backend/assets/vendor/js/helpers.js') }}"></script>
    <script src="{{ asset('/backend/assets/js/config.js') }}"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/41.0.0/classic/ckeditor.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" />

    <!-- Responsive DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css" />
    <!-- JQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">

    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

    <style>
        /* Fix SweetAlert scrollbar jump */

        body.swal2-shown {
            padding-right: 0 !important;
            overflow: hidden !important;
        }


        .select2-container {
            display: block !important;
            width: 100% !important;
        }

        .select2-container .select2-dropdown {
            z-index: 999999 !important;
        }

        .select2-container .select2-selection {
            z-index: 999999 !important;
        }
    </style>
</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->
            @include('admin.menu_admin.sidebar')
            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->
                <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
                    id="layout-navbar">
                    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
                        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                            <i class="bx bx-menu bx-sm"></i>
                        </a>
                    </div>
                    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
                        <!-- /Search -->
                        <ul class="navbar-nav flex-row align-items-center ms-auto">
                            <!-- User -->
                            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);"
                                    data-bs-toggle="dropdown">
                                    <div class="avatar avatar-online">
                                        <img src="{{ asset('backend/assets/img/avatars/1.png') }}"
                                            alt class="w-px-40 h-auto rounded-circle" />
                                    </div>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a class="dropdown-item" href="#">
                                            <div class="d-flex">
                                                <div class="flex-shrink-0 me-3">
                                                    <div class="avatar avatar-online">
                                                        <img src="{{ asset('backend/assets/img/avatars/1.png') }}"
                                                            alt class="w-px-40 h-auto rounded-circle" />
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <span class="fw-semibold d-block">{{ Auth::user()->name }}</span>
                                                    <small class="text-muted">{{ Auth::user()->role->name }}</small>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <div class="dropdown-divider"></div>
                                    </li>
                                    <li>
                                        <a href="#" class="dropdown-item" onclick="confirmLogout(event)">
                                            <i class="bx bx-power-off me-2"></i>
                                            <span class="align-middle">Log Out</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </nav>
                <!-- / Navbar -->
                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->
                    @yield('content')
                    <!-- / Content -->
                    <!-- Footer -->
                    <footer class="content-footer footer bg-footer-theme">
                        <div
                            class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
                            <div class="mb-2 mb-md-0">
                                Developer by Zaki Anshari
                            </div>

                            <div>
                                <script>
                                    document.write(new Date().getFullYear());
                                </script>
                            </div>
                        </div>
                    </footer>
                    <!-- / Footer -->
                    <div class="content-backdrop fade"></div>
                </div>
                <!-- Content wrapper -->
            </div>
            <!-- / Layout page -->
        </div>
        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{ asset('/backend/assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('/backend/assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('/backend/assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('/backend/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('/backend/assets/vendor/js/menu.js') }}"></script>
    <!-- Vendors JS -->
    <script src="{{ asset('/backend/assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>
    <!-- Main JS -->
    <script src="{{ asset('/backend/assets/js/main.js') }}"></script>
    <!-- Page JS -->
    <script src="{{ asset('/backend/assets/js/dashboards-analytics.js') }}"></script>
    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    @stack('scripts')
    {{-- //confirmasi logout --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    {{-- SweetAlert include: render alert script after SweetAlert2 is loaded --}}
    @include('sweetalert::alert')
    <script>
        function confirmLogout(event) {
            event.preventDefault();
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Anda akan keluar dari sistem!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Keluar!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '/logout';
                }
            });
        }
    </script>
    {{-- Jam Digital --}}
    <script>
        function updateClock() {
            const now = new Date();
            const hours = now.getHours().toString().padStart(2, '0');
            const minutes = now.getMinutes().toString().padStart(2, '0');
            const seconds = now.getSeconds().toString().padStart(2, '0');

            const timeString = `${hours}:${minutes}:${seconds}`;
            document.getElementById('digital-clock').textContent = timeString;
        }
        // Jalankan setiap 1 detik
        setInterval(updateClock, 1000);
        // Panggil sekali saat pertama kali halaman dimuat
        updateClock();
    </script>
    {{-- FORMAT RUPIAH --}}
    <script>
        function formatRupiah(angka) {
            let number_string = angka.replace(/[^,\d]/g, '').toString(),
                split = number_string.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/g);

            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;
            return rupiah;
        }

        document.getElementById('price').addEventListener('keyup', function(e) {
            this.value = formatRupiah(this.value);
        });

        // Convert back to plain number before submit
        document.querySelector('form').addEventListener('submit', function() {
            const input = document.getElementById('price');
            input.value = input.value.replace(/\./g, '').replace(/,/g, '.');
        });
    </script>

    {{-- MENAMPILKAN CLOSE KECIL --}}
    <script>
        const imageInput = document.getElementById("imageInput");
        const imagePreview = document.getElementById("imagePreview");
        const removeBtn = document.getElementById("removeImageBtn");

        imageInput.addEventListener("change", function() {
            const file = this.files[0];

            if (file) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    imagePreview.src = e.target.result;
                    imagePreview.style.display = "block";
                    removeBtn.style.display = "inline-block";
                };

                reader.readAsDataURL(file);
            }
        });

        removeBtn.addEventListener("click", function() {
            // Reset input file
            imageInput.value = "";

            // Hilangkan preview dan tombol
            imagePreview.src = "#";
            imagePreview.style.display = "none";
            removeBtn.style.display = "none";
        });
    </script>
    {{-- SCRIPT UNTUK MENYEMBUNYIKAN FORM SEAT DAN MILES --}}
    <script>
        document.addEventListener("DOMContentLoaded", function() {

            const categorySelect = document.getElementById("category_id");
            const seatsDiv = document.getElementById("seats_div");
            const milesDiv = document.getElementById("miles_div");
            const descriptionDiv = document.getElementById("description_div");

            function toggleFields() {
                const category = categorySelect.value;

                // Seats hanya tampil di category_id = 1
                seatsDiv.style.display = (category == "1") ? "block" : "none";

                // Miles hilang di category_id 3 dan 4
                milesDiv.style.display = (category == "3" || category == "4") ? "none" : "block";

                // Deskripsi hanya tampil di category_id 3 dan 4
                descriptionDiv.style.display = (category == "3" || category == "4") ? "block" : "none";
            }

            // Saat halaman pertama kali dibuka
            toggleFields();

            // Saat user memilih kategori
            categorySelect.addEventListener("change", toggleFields);
        });
    </script>

    <script src="{{ asset('/backend/assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2({
                theme: 'bootstrap4',
                placeholder: "Pilih kategori",
                allowClear: true,
                width: '100%',
                dropdownParent: $('.select2').closest('.col-lg-6')
            });
        });
    </script>
    <script>
        ClassicEditor
            .create(document.querySelector('#editor_value'))
            .catch(error => {
                console.error(error);
            });
    </script>
    {{-- INI SCRIPT UNTUK SPESIFIACTIO FORM --}}
    <script>
        let index = 1;

        function addRow() {
            let table = document.querySelector('#spec_table tbody');

            let row = `
                                                                    <tr>
                                                                        <td><input type="text" name="specs[${index}][label]" class="form-control" placeholder="Label"></td>
                                                                        <td><input type="text" name="specs[${index}][value]" class="form-control" placeholder="Nilai"></td>
                                                                        <td>
                                                                            <button type="button" class="btn btn-danger btn-sm" onclick="removeRow(this)">x</button>
                                                                        </td>
                                                                    </tr>
                                                                `;

            table.insertAdjacentHTML('beforeend', row);
            index++;
        }

        function removeRow(button) {
            button.closest('tr').remove();
        }
    </script>

</body>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
{{-- SCRIPT PRODUCT --}}
<script>
    $(document).ready(function() {
        let table = $('#productTable').DataTable({
            responsive: true,
            autoWidth: false,
            pageLength: 10,
            ordering: true,
            columnDefs: [{
                    targets: 0,
                    orderable: false
                }, // No
                {
                    targets: -1,
                    orderable: false
                }, // Aksi
            ]
        });

        // Auto-numbering ulang setiap pagination / sorting
        table.on('order.dt search.dt', function() {
            let i = 1;

            table.cells(null, 0, {
                search: 'applied',
                order: 'applied'
            }).every(function() {
                this.data(i++);
            });
        }).draw();
    });
</script>
{{-- SCRIPT CATEGORY --}}
<script>
    $(document).ready(function() {
        let table = $('#categoryTable').DataTable({
            responsive: true,
            autoWidth: false,
            pageLength: 10,
            ordering: true,
            columnDefs: [{
                    targets: 0,
                    orderable: false
                }, // No
                {
                    targets: -1,
                    orderable: false
                }, // Aksi
            ]
        });

        // Auto numbering kolom "No"
        table.on('order.dt search.dt', function() {
            let i = 1;

            table.cells(null, 0, {
                    search: 'applied',
                    order: 'applied'
                })
                .every(function() {
                    this.data(i++);
                });
        }).draw();
    });
</script>
{{-- SCRIP BRAND --}}
<script>
    $(document).ready(function() {

        $('.datatable').each(function() {

            let table = $(this).DataTable({
                responsive: true,
                autoWidth: false,
                pageLength: 10,
                ordering: true,
                columnDefs: [{
                        targets: 0,
                        orderable: false
                    }, // Kolom No
                    {
                        targets: -1,
                        orderable: false
                    }, // Kolom Aksi
                ]
            });

            // Auto numbering
            table.on('order.dt search.dt', function() {
                let i = 1;

                table.cells(null, 0, {
                        search: 'applied',
                        order: 'applied'
                    })
                    .every(function() {
                        this.data(i++);
                    });
            }).draw();

        });

    });
</script>
<!-- Script tambah row POWER-->
<script>
    let powerIndex = 1;

    function addPowerRow() {
        const table = document.getElementById('power_table').getElementsByTagName('tbody')[0];
        const row = document.createElement('tr');

        row.innerHTML = `
                                <td><input type="text" name="powers[${powerIndex}][label]" class="form-control"></td>
                                <td><input type="text" name="powers[${powerIndex}][nilai]" class="form-control"></td>
                                <td>
                                    <button type="button" class="btn btn-danger btn-sm" onclick="removeRow(this)">-</button>
                                </td>
                            `;

        table.appendChild(row);
        powerIndex++;
    }

    function removeRow(btn) {
        btn.closest('tr').remove();
    }
</script>
<!-- Script tambah row Dimensi-->
<script>
    let dimensiIndex = 1;

    function addDimensiRow() {
        const table = document.getElementById('dimensi_table').getElementsByTagName('tbody')[0];
        const row = document.createElement('tr');

        row.innerHTML = `
            <td><input type="text" name="dimensis[${dimensiIndex}][label]" class="form-control"></td>
            <td><input type="text" name="dimensis[${dimensiIndex}][nilai]" class="form-control"></td>
            <td><button type="button" class="btn btn-danger btn-sm" onclick="removeRow(this)">-</button></td>
        `;

        table.appendChild(row);
        dimensiIndex++;
    }

    function removeRow(btn) {
        btn.closest('tr').remove();
    }
</script>
<!-- Script tambah row khusus Suspensi -->
<script>
    let suspensiIndex = 1;

    function addSuspensiRow() {
        const table = document.getElementById('suspensi_table').getElementsByTagName('tbody')[0];
        const row = document.createElement('tr');

        row.innerHTML = `
            <td><input type="text" name="suspensis[${suspensiIndex}][label]" class="form-control"></td>
            <td><input type="text" name="suspensis[${suspensiIndex}][nilai]" class="form-control"></td>
            <td><button type="button" class="btn btn-danger btn-sm" onclick="removeRow(this)">-</button></td>
        `;

        table.appendChild(row);
        suspensiIndex++;
    }

    function removeRow(btn) {
        btn.closest('tr').remove();
    }
</script>
<!-- Script tambah row untuk Fitur -->
{{-- SCRIPT TAMBAH/HAPUS BARIS FITUR --}}
<script>
    let fiturIndex = 1;

    function addFiturRow() {
        const tableBody = document.getElementById('fitur_table').getElementsByTagName('tbody')[0];
        const row = document.createElement('tr');

        row.innerHTML = `
            <td><input type="text" name="fiturs[${fiturIndex}][label]" class="form-control"></td>
            <td><input type="text" name="fiturs[${fiturIndex}][nilai]" class="form-control"></td>
            <td><button type="button" class="btn btn-danger btn-sm" onclick="removeRow(this)">-</button></td>
        `;

        tableBody.appendChild(row);
        fiturIndex++;
    }

    function removeRow(button) {
        button.closest('tr').remove();
    }
</script>
{{-- TEXT AREA --}}
{{-- <script src="https://cdn.ckeditor.com/ckeditor5/39.0.2/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create(document.querySelector('#editor'))
        .catch(error => {
            console.error(error);
        });
</script> --}}
{{-- END TEXT AREA --}}

{{-- INI SCRIPT UNTUK PREVIEW SEMUA IMAGE --}}
<script>
    document.addEventListener("DOMContentLoaded", function() {

        // Fungsi umum untuk preview
        function setupImagePreview(inputId, previewId) {
            const input = document.getElementById(inputId);
            const preview = document.getElementById(previewId);
            if (!input || !preview) return;

            input.addEventListener('change', function() {
                const file = this.files[0];
                if (!file) {
                    preview.style.display = 'none';
                    preview.src = '#';
                    return;
                }

                // Validasi tipe file
                const validTypes = ['image/png', 'image/jpg', 'image/jpeg'];
                if (!validTypes.includes(file.type)) {
                    alert("Format gambar harus PNG, JPG, atau JPEG!");
                    this.value = '';
                    preview.style.display = 'none';
                    return;
                }

                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                };
                reader.readAsDataURL(file);
            });
        }

        // Setup semua input/preview
        setupImagePreview('imageInput2', 'imagePreview2');
        setupImagePreview('imageInput3', 'imagePreview3');

    });
</script>

{{-- INI TEXT EDITOR HUGERTE --}}
<script src="https://cdn.jsdelivr.net/npm/hugerte@latest/hugerte.min.js"></script>
<script>
    hugerte.init({
        selector: '#description',
        height: 350,

        branding: false, // ⬅️ INI KUNCINYA
        elementpath: false, // ⬅️ HILANGKAN "p"

        menubar: 'file edit view insert format tools table help',
        plugins: [
            'advlist autolink lists link image charmap preview anchor',
            'searchreplace visualblocks code fullscreen',
            'insertdatetime media table help wordcount'
        ],
        toolbar: 'undo redo | formatselect | bold italic underline | ' +
            'alignleft aligncenter alignright alignjustify | ' +
            'bullist numlist outdent indent | ' +
            'link image media table | code fullscreen'
    });
</script>

</html>
