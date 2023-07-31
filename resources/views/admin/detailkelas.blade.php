<x-admin.template-admin :title="$judul" :menu-utama="$menuUtama" :menu-kedua="$menuKedua">
    @push('cssCustom')
        <link rel="stylesheet" href="{{asset('template/vendor/datatables/media/css/dataTables.bootstrap5.css')}}"/>
        <link rel="stylesheet" href="{{asset('template/vendor/pnotify/pnotify.custom.css')}}"/>
    @endpush
    <section role="main" class="content-body">
        <header class="page-header page-header-left-breadcrumb">
            <div class="right-wrapper">
                <ol class="breadcrumbs">
                    <li>
                        <a href="{{route('adm.dashboard')}}">
                            <i class="bx bx-home-alt"></i>
                        </a>
                    </li>
                    <li><span>Master</span></li>
                    <li><span>Kelas</span></li>
                    <li><span>{{strtoupper($dataKelas->name)}}</span></li>
                </ol>

            </div>
            <h2 class="font-weight-semibold">Detail Kelas <span
                    class="text-primary">{{strtoupper($dataKelas->name)}}</span></h2>
        </header>

        <!-- start: statistik -->
        <div class="row">
            <div class="col-xl-3">
                <section class="card card-featured-left card-featured-primary mb-3">
                    <div class="card-body">
                        <div class="widget-summary">
                            <div class="widget-summary-col widget-summary-col-icon">
                                <div class="summary-icon bg-primary">
                                    <i class="fas fa-life-ring"></i>
                                </div>
                            </div>
                            <div class="widget-summary-col">
                                <div class="summary">
                                    <h4 class="title">Total Mahasiswa</h4>
                                    <div class="info">
                                        <strong class="amount">{{$jmlMahasiswa}}</strong>
                                    </div>
                                </div>
                                <div class="summary-footer">
                                    <a class="text-muted text-uppercase" href="{{route('adm.mahasiswa')}}">(view all)</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

        </div>
        <!-- end: statistik -->

        <!-- start: data mahasiswa -->
        <div class="row">
            <div class="col-lg-12 mb-3">
                <section class="card">
                    <header class="card-header">
                        <div class="card-actions">
                            <button class="btn btn-sm btn-primary open-nonkelas" data-bs-toggle="modal"
                                    data-bs-target="#modalTambah"><i class='bx bx-duplicate'></i></button>
                        </div>
                        <h2 class="card-title">DATA MAHASISWA</h2>
                    </header>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xl-12">
                                <table id="tabelMahasiswa" class="table table-bordered table-striped mb-0"
                                       style="width: 100%">
                                    <thead>
                                    <tr>
                                        <th scope="col" class="text-center">#</th>
                                        <th scope="col" class="text-center">NIM</th>
                                        <th scope="col" class="text-center">NAMA</th>
                                        <th scope="col" class="text-center">ACTION</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{route('adm.kelas')}}">
                            <button class="btn btn-sm btn-danger">Kembali</button>
                        </a>
                    </div>
                </section>
            </div>
        </div>
        <!-- end: data mahasiswa -->
    </section>
    <!-- START : Modal TAMBAH -->
    <div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <!-- Start: Code -->
                    <div class="row mt-2">
                        <div class="col-md-12">
                            <table id="tabelMahasiswaNonKelas" class="table table-bordered table-striped mb-0"
                                   style="width: 100%">
                                <thead>
                                <tr>
                                    <th scope="col" class="text-center">#</th>
                                    <th scope="col" class="text-center">NIM</th>
                                    <th scope="col" class="text-center">NAMA</th>
                                    <th scope="col" class="text-center">ACTION</th>
                                </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- End: Code -->

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                </div>

            </div>
        </div>
    </div>
    <!-- END : Modal TAMBAH -->

    <!-- START : Modal KONFIRM -->
    <div class="modal fade" id="modalKonfirm" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Konfirmasi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{route('adm.kelas.tambah_siswa',base64_encode($dataKelas->id))}}" method="post">
                    @csrf
                    <div class="modal-body">
                        <!-- Start: Code -->
                        <div class="row mt-2">
                            <div class="col-md-12">
                                <label for="user_id" class="hidden"></label>
                                <input type="hidden" class="form-control" name="user_id" id="user_id">
                                Apakah anda ingin menambahkan data siswa ini ke dalam kelas?
                            </div>
                        </div>
                        <!-- End: Code -->

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success" data-bs-dismiss="modal">Tambahkan</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <!-- END : Modal KONFIRM -->

        <!-- START : Modal KONFIRM -->
        <div class="modal fade" id="modalLepas" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Konfirmasi</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{route('adm.kelas.tambah_siswa',base64_encode($dataKelas->id))}}" method="post">
                        @csrf
                        @method('DELETE')
                        <div class="modal-body">
                            <!-- Start: Code -->
                            <div class="row mt-2">
                                <div class="col-md-12">
                                    <label for="user_id_lepas" class="hidden"></label>
                                    <input type="hidden" class="form-control" name="user_id" id="user_id_lepas">
                                    Apakah anda ingin menghapus siswa ini dari daftar kelas?
                                </div>
                            </div>
                            <!-- End: Code -->

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-danger" data-bs-dismiss="modal">Hapus</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
        <!-- END : Modal KONFIRM -->


    @push('customJS')
        <script src="{{asset('template/vendor/pnotify/pnotify.custom.js')}}"></script>
        <x-admin.toast-message/>
        <script>
            $(document).ready(function () {
                let base_url = "{{route('ajax.getsiswakelas')}}";
                let kelas_id = "{{$dataKelas->id}}";
                /** saat tombol hapus di klik */
                $(document).on("click", ".open-hapus", function (e) {
                    e.preventDefault();
                    let fid = $(this).data('id');
                    $('#hapususer_id').val(fid);
                })

                $(document).on("click", ".open-konfirm", function (e) {
                    e.preventDefault();
                    let fid = $(this).data('id');
                    $('#user_id').val(fid);
                })

                $(document).on("click", ".open-lepas", function (e) {
                    e.preventDefault();
                    let fid = $(this).data('id');
                    $('#user_id_lepas').val(fid);
                })


                $(document).on("click", ".open-nonkelas", function (e) {
                    e.preventDefault();
                    getDataMahasiswaNonKelas();
                })

                $('.modal').on('hidden.bs.modal', function (e) {
                    e.preventDefault();
                    let pesanError = $('.errorMessage');
                    let errorInput = $('.errorInput');
                    let errorLabel = $('.errorLabel');
                    pesanError.html("");
                    errorInput.removeClass('is-invalid');
                    errorLabel.removeClass('text-danger');
                })

                function getDataMahasiswaNonKelas() {
                    let urlMahasiswaNonKelas = '{{route('ajax.getsiswanonkelas')}}';
                    $('#tabelMahasiswaNonKelas').DataTable({
                        responsive: true,
                        processing: true,
                        serverSide: true,
                        ajax: {
                            type: 'GET',
                            url: urlMahasiswaNonKelas,
                            async: true,
                        },
                        language: {
                            processing: "Loading",
                        },
                        columns: [
                            {
                                data: 'index',
                                class: 'text-center',
                                defaultContent: '',
                                orderable: false,
                                searchable: false,
                                width: '5%',
                                render: function (data, type, row, meta) {
                                    return meta.row + meta.settings._iDisplayStart + 1; //auto increment
                                }
                            },
                            {data: 'nim', class: 'text-center'},
                            {data: 'user.name', class: 'text-center'},
                            {data: 'action', class: 'text-center', orderable: false},
                        ],
                        "bDestroy": true
                    });
                }

                $('#tabelMahasiswa').DataTable({
                    responsive: true,
                    processing: true,
                    serverSide: true,
                    ajax: {
                        type: 'GET',
                        url: base_url,
                        async: true,
                        data: {
                            'kelas_id': kelas_id
                        }
                    },
                    language: {
                        processing: "Loading",
                    },
                    columns: [
                        {
                            data: 'index',
                            class: 'text-center',
                            defaultContent: '',
                            orderable: false,
                            searchable: false,
                            width: '5%',
                            render: function (data, type, row, meta) {
                                return meta.row + meta.settings._iDisplayStart + 1; //auto increment
                            }
                        },
                        {data: 'nim', class: 'text-center'},
                        {data: 'user.name', class: 'text-center'},
                        {data: 'action', class: 'text-center', orderable: false},
                    ],
                    "bDestroy": true
                });
            });
        </script>
    @endpush
</x-admin.template-admin>
