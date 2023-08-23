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
                    <li><span>Dashboard</span></li>
                </ol>
            </div>

            <h2 class="font-weight-semibold">Dashboard</h2>
        </header>

        <!-- start: page -->
        <div class="row">
            <div class="col-lg-6 mb-3">
                <section class="card">
                    <div class="card-header">
                        <h1 class="card-title">Daftar Mahasiswa Terbaru</h1>
                    </div>
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
                                        @php
                                            $no = 1;
                                        @endphp
                                        @foreach($dataUser->where('role_id','3')->take(5) as $row)
                                            <tr>
                                                <td class="text-center">{{$no++}}</td>
                                                <td class="text-start">{{$row->mahasiswa->nim}}</td>
                                                <td class="text-start">{{$row->name}}</td>
                                                <td class="text-start">{{$row->email}}</td>
                                                <td class="text-center"><a href="{{route('adm.mahasiswa.detail',base64_encode($row->id))}}"><button class="btn btn-primary btn-sm"><i class="fa fa-eye"></i></button></a></td>
                                            </tr>
                                        @endforeach

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                    </div>
                </section>
            </div>
            <div class="col-lg-6">
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
                                            <h4 class="title">Total Mahasiswa</h4>
                                            <div class="info">
                                                <strong class="amount">{{$dataUser->where('role_id','3')->count()}}</strong>
                                            </div>
                                        </div>
                                        <div class="summary-footer">
                                            <a class="text-muted text-uppercase" href="#">(view all)</a>
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
                                            <i class="fas fa-dollar-sign"></i>
                                        </div>
                                    </div>
                                    <div class="widget-summary-col">
                                        <div class="summary">
                                            <h4 class="title">Total Dosen</h4>
                                            <div class="info">
                                                <strong class="amount">{{$dataUser->where('role_id','2')->count()}}</strong>
                                            </div>
                                        </div>
                                        <div class="summary-footer">
                                            <a class="text-muted text-uppercase" href="#">(View All)</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-6">
                        <section class="card card-featured-left card-featured-tertiary mb-3">
                            <div class="card-body">
                                <div class="widget-summary">
                                    <div class="widget-summary-col widget-summary-col-icon">
                                        <div class="summary-icon bg-tertiary">
                                            <i class="fas fa-shopping-cart"></i>
                                        </div>
                                    </div>
                                    <div class="widget-summary-col">
                                        <div class="summary">
                                            <h4 class="title">Hasil Forward Chaining</h4>
                                            <div class="info">
                                                <strong class="amount">2</strong>
                                            </div>
                                        </div>
                                        <div class="summary-footer">
                                            <a class="text-muted text-uppercase" href="#">(Mahasiswa Layak Skripsi)</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                    <div class="col-xl-6">
                        <section class="card card-featured-left card-featured-quaternary">
                            <div class="card-body">
                                <div class="widget-summary">
                                    <div class="widget-summary-col widget-summary-col-icon">
                                        <div class="summary-icon bg-quaternary">
                                            <i class="fas fa-user"></i>
                                        </div>
                                    </div>
                                    <div class="widget-summary-col">
                                        <div class="summary">
                                            <h4 class="title">Belum Siap Skripsi</h4>
                                            <div class="info">
                                                <strong class="amount">0</strong>
                                            </div>
                                        </div>
                                        <div class="summary-footer">
                                            <a class="text-muted text-uppercase" href="#">(VIEW ALL)</a>
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
    </section>
    @push('customJS')
            <script src="{{asset('template/vendor/pnotify/pnotify.custom.js')}}"></script>
            <x-admin.toast-message/>
        <script>
            $(document).ready(function () {
                $('#tabel1').DataTable({
                    responsive: true,
                    searching: false
                });
            })
        </script>
    @endpush
</x-admin.template-admin>
