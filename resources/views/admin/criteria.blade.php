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
                    <li><span>Kriteria Penyusunan Skripsi</span></li>
                </ol>

            </div>
            <h2 class="font-weight-semibold">Kriteria Penyusunan Skripsi</h2>
        </header>

        <!-- start: page -->
        <div class="row">
            <div class="col-lg-12 mb-3">
                <section class="card">
                    <header class="card-header">
{{--                        <div class="card-actions">--}}
{{--                           <button class="btn btn-sm btn-primary"><i class='bx bx-duplicate' ></i></button>--}}
{{--                        </div>--}}

                        <h2 class="card-title">Kriteria Penyusunan Skripsi</h2>
                    </header>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xl-12">
                                <table id="tabel1" class="table table-bordered table-striped mb-0" style="width: 100%">
                                    <thead>
                                    <tr>
                                        <th scope="col" class="text-center">#</th>
                                        <th scope="col" class="text-center">PREMIS</th>
                                        <th scope="col" class="text-center">KRITERIA KELULUSAN</th>
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
                let base_url = "{{route('adm.criteria')}}";
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
                        {data: 'premis', class: 'text-center'},
                        {data: 'criteria', class: 'text-left'},
                    ],
                    "bDestroy": true
                });
            });
        </script>
    @endpush
</x-admin.template-admin>
