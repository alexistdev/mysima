<x-admin.template-admin :title="$judul" :menu-utama="$menuUtama" :menu-kedua="$menuKedua">
    @push('cssCustom')
        <link rel="stylesheet" href="{{asset('template/vendor/datatables/media/css/dataTables.bootstrap5.css')}}"/>
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
                        <a href="{{route('adm.mahasiswa')}}"><button class="btn btn-sm btn-danger float-end">KEMBALI</button></a>
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
                    </header>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>NO</th>
                                        <th>MATA KULIAH</th>
                                        <th>SKS</th>
                                        <th>UTS</th>
                                        <th>UAS</th>
                                        <th>PRESENSI</th>
                                        <th>TOTAL</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>-</td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td>-</td>
                                    </tr>
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>

                </section>
            </div>
        </div>
    </section>
    @push('customJS')

        <script>
            $(document).ready(function () {
                let base_url = "{{route('adm.dosen')}}";
                $('#tabel1').DataTable({
                    responsive: true,
                    processing: true,
                    serverSide: true,
                    ajax: {
                        type: 'GET',
                        url: base_url,
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
                        {data: 'name', class: 'text-center'},
                        {data: 'email', class: 'text-center'},
                        {data: 'created_at', class: 'text-center'},
                        {data: 'action', class: 'text-center', orderable: false},
                    ],
                    "bDestroy": true
                });
            });
        </script>
    @endpush
</x-admin.template-admin>
