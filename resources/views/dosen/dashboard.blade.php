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
                        <a href="{{route('dosen.dashboard')}}">
                            <i class="bx bx-home-alt"></i>
                        </a>
                    </li>
                </ol>

            </div>

            <h2 class="font-weight-semibold">Dashboard</h2>
        </header>

        <!-- start: page -->
        <div class="row">

            <div class="col-lg-12">
                <div class="row mb-3">
                    <div class="col-xl-6">
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
                                            <h4 class="title">Hasil Analisis (Forward Chaining)</h4>
                                            <div class="info">
                                                <strong class="amount">{{$dataForward->count()}}</strong>
                                            </div>
                                        </div>
                                        <div class="summary-footer">
                                            <a class="text-muted text-uppercase" href="#">(Siswa Layak Skripsi)</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                    <div class="col-xl-6">
                        <section class="card card-featured-left card-featured-secondary">
                            <div class="card-body">
                                <div class="widget-summary">
                                    <div class="widget-summary-col widget-summary-col-icon">
                                        <div class="summary-icon bg-secondary">
                                            <i class="fas fa-users"></i>
                                        </div>
                                    </div>
                                    <div class="widget-summary-col">
                                        <div class="summary">
                                            <h4 class="title">Total Siswa</h4>
                                            <div class="info">
                                                <strong class="amount">{{$totalSiswa}}</strong>
                                            </div>
                                        </div>
                                        <div class="summary-footer">
                                            <a class="text-muted text-uppercase" href="#">(View)</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
        <!-- end: page -->
        <div class="row">
            <div class="col-lg-12 mb-3">
                <section class="card">
                    <div class="card-header">
                        <form action="{{route('dosen.dashboard.filter')}}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-lg-3">
                                    <select name="skripsi" id="skripsi" class="form-control col-lg-3" >
                                        <option value="">==PILIH==</option>
                                        <option value="1">SKRIPSI</option>
                                    </select>
                                </div>
                                <div class="col-lg-3">
                                    <button type="submit" class="btn btn-primary">FILTER</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xl-12">
                                <table id="tabelFW" class="table table-bordered table-striped mb-0" style="width: 100%">
                                    <thead>
                                    <tr>
                                        <th scope="col" class="text-center">#</th>
                                        <th scope="col" class="text-center">NPM</th>
                                        <th scope="col" class="text-center">NAMA</th>
                                        <th scope="col" class="text-center">SKS</th>
                                        <th scope="col" class="text-center">SKRIPSI</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php
                                        $no=1;
                                    @endphp
                                    @foreach($dataForward as $row)
                                        <tr>
                                            <td class="text-center">{{$no++}}</td>
                                            <td class="text-start">{{$row->mahasiswa->nim ?? "-"}}</td>
                                            <td class="text-start">{{$row->mahasiswa->user->name ?? "-"}}</td>
                                            <td class="text-center">{{$row->jumlahsks}}</td>
                                            <td class="text-center">YES</td>
                                        </tr>
                                    @endforeach
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
        <!-- Specific Page Vendor -->
        <script src="{{asset('template/vendor/pnotify/pnotify.custom.js')}}"></script>
        <x-admin.toast-message/>
            <script>
                $(document).ready(function () {
                    $('#tabelFW').DataTable();
                });
            </script>
    @endpush
</x-admin.template-admin>
