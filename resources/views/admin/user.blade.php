<x-admin.template-admin :title="$judul" :menu-utama="$menuUtama" :menu-kedua="$menuKedua">
    @push('cssCustom')
        <link rel="stylesheet" href="{{asset('template/vendor/datatables/media/css/dataTables.bootstrap5.css')}}" />
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
                </ol>

            </div>
            <h2 class="font-weight-semibold">Data Mahasiswa</h2>
        </header>

        <!-- start: page -->
        <div class="row">
            <div class="col-lg-12 mb-3">
                <section class="card">
                    <header class="card-header">
                        <div class="card-actions">
                            <a href="{{route('adm.mahasiswa.add')}}"><button class="btn btn-sm btn-primary"><i class='bx bx-duplicate' ></i></button></a>
                        </div>

                        <h2 class="card-title">Data Mahasiswa</h2>
                    </header>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xl-12">
                                <table id="tabel1" class="table table-bordered table-striped mb-0" style="width: 100%">
                                    <thead>
                                    <tr>
                                        <th scope="col" class="text-center">#</th>
                                        <th scope="col" class="text-center">NPM</th>
                                        <th scope="col" class="text-center">NAMA</th>
                                        <th scope="col" class="text-center">EMAIL</th>
                                        <th scope="col" class="text-center">ACTION</th>
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
        <!-- end: page -->
    </section>
    @push('customJS')

        <script>
            $(document).ready(function () {
                let base_url = "{{route('adm.mahasiswa')}}";
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
                        {data: 'mahasiswa.nim', class: 'text-center'},
                        {data: 'name', class: 'text-center'},
                        {data: 'email', class: 'text-center'},
                        {data: 'action', class: 'text-center', orderable: false},
                    ],
                    "bDestroy": true
                });
            });
        </script>
    @endpush
</x-admin.template-admin>
