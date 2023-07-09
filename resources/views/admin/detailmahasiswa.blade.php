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
                    <li><span>Mahasiswa</span></li>
                    <li><span>{{$dataMahasiswa->name}}</span></li>
                </ol>

            </div>
            <h2 class="font-weight-semibold">Detail Mahasiswa Mahasiswa</h2>
        </header>

        <!-- start: page -->
        <div class="row">
            <div class="col-lg-12 mb-3">
                <section class="card">
                    <header class="card-header">
                        <h2 class="card-title">Informasi</h2>
                        <a href="{{route('adm.mahasiswa')}}">
                            <button class="btn btn-sm btn-danger float-end">KEMBALI</button>
                        </a>
                    </header>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <table class="table table-striped">
                                    <tbody>
                                    <tr>
                                        <th scope="row" style="width: 20%">Nama Mahasiswa</th>
                                        <td style="width: 5%">:</td>
                                        <td>{{$dataMahasiswa->name ?? "-"}}</td>

                                    </tr>
                                    <tr>
                                        <th scope="row" style="width: 20%">NPM</th>
                                        <td style="width: 5%">:</td>
                                        <td>{{$dataMahasiswa->mahasiswa->nim ?? "-"}}</td>

                                    </tr>
                                    <tr>
                                        <th scope="row" style="width: 20%">Email</th>
                                        <td style="width: 5%">:</td>
                                        <td>{{$dataMahasiswa->email ?? "-"}}</td>

                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-lg-6">
                                <table class="table table-striped">
                                    <tbody>
                                    <tr>
                                        <th scope="row" style="width: 20%">Phone</th>
                                        <td style="width: 5%">:</td>
                                        <td>{{$dataMahasiswa->mahasiswa->phone ?? "-"}}</td>

                                    </tr>
                                    <tr>
                                        <th scope="row" style="width: 20%">Alamat</th>
                                        <td style="width: 5%">:</td>
                                        <td>{{$dataMahasiswa->mahasiswa->alamat ?? "-"}}</td>

                                    </tr>

                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </section>
            </div>
        </div>
        <!-- end: page -->
        <div class="row">
            <div class="col-lg-12 mb-3">

                <section class="card">
                    <header class="card-header">
                        <h2 class="card-title">SKS</h2>
                        <button class="btn btn-sm btn-primary float-end" data-bs-toggle="modal" data-bs-target="#modalTambah">Tambah</button>
                    </header>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <table id="tabelSKS" class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>NO</th>
                                        <th>KODE</th>
                                        <th>NAME</th>
                                        <th>SKS</th>
                                        <th>NILAI UTS</th>
                                        <th>NILAI UAS</th>
                                        <th>PRESENSI</th>
                                        <th>TOTAL</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>

                </section>
            </div>
        </div>
    </section>

    <!-- START : Modal Tambah -->
    <div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Daftar Matakuliah</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table id="tabel1" class="table table-striped">
                        <thead>
                        <tr>
                            <th>NO</th>
                            <th>KODE</th>
                            <th>NAME</th>
                            <th>SKS</th>
                            <th>ACTION</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- END : Modal Tambah -->

        <!-- START : Modal Add -->
        <div class="modal fade" id="modalAdd" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <form action="{{route('adm.mahasiswa.matkul.add',$idUser)}}" method="post">
                    @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Mata Kuliah</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="matakuliah_id" id="matakuliah_id">
                       Apakah anda ingin menambahkan mata kuliah ini ?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Tambahkan</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
        <!-- END : Modal Add -->
    @push('customJS')
            <script src="{{asset('template/vendor/pnotify/pnotify.custom.js')}}"></script>
            <x-admin.toast-message/>
        <script>
            $(document).on("click", ".open-matkul", function (e) {
                e.preventDefault();
                let fid = $(this).data('id');
                $('#matakuliah_id').val(fid);
            })

            $(document).ready(function () {
                let base_url = "{{route('ajax.datamatkul')}}";
                let url_sks = "{{route('ajax.sks')}}";
                let user_id = "{{$dataMahasiswa->id}}"
                $('#tabel1').DataTable({
                    responsive: true,
                    processing: true,
                    serverSide: true,
                    ajax: {
                        type: 'GET',
                        url: base_url,
                        async: true,
                        data: {
                            user_id: user_id
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
                        {data: 'code', class: 'text-center'},
                        {data: 'name', class: 'text-center'},
                        {data: 'sks', class: 'text-center'},
                        {data: 'action', class: 'text-center', orderable: false},
                    ],
                    "bDestroy": true
                });

                $('#tabelSKS').DataTable({
                    responsive: true,
                    processing: true,
                    serverSide: true,
                    ajax: {
                        type: 'GET',
                        url: url_sks,
                        async: true,
                        data: {
                            user_id: user_id
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
                        {data: 'matkul.code', class: 'text-center'},
                        {data: 'matkul.name', class: 'text-center'},
                        {data: 'matkul.sks', class: 'text-center'},
                        {data: 'uts', class: 'text-center'},
                        {data: 'uas', class: 'text-center'},
                        {data: 'presensi', class: 'text-center'},
                        {data: 'total', class: 'text-center'},
                        // {data: 'action', class: 'text-center', orderable: false},
                    ],
                    "bDestroy": true
                });
            });
        </script>
    @endpush
</x-admin.template-admin>
