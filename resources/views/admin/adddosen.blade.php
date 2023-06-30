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
                    <li><span>Dosen</span></li>
                    <li><span>Add</span></li>
                </ol>

            </div>
            <h2 class="font-weight-semibold">Tambah Data Dosen</h2>
        </header>

        <!-- start: page -->
        <div class="row">
            <div class="col-lg-12 mb-3">
                <form action="{{route('adm.dosen.save')}}" class="form-horizontal form-bordered" method="post">
                <section class="card">
                    <header class="card-header">

                        <h2 class="card-title">FORM TAMBAH DOSEN</h2>
                    </header>
                    <div class="card-body">

                        <div class="row">
                            <div class="col-xl-6">

                                    @csrf
                                    <div class="form-group row pb-4">
                                        <label class="col-lg-3 control-label text-lg-end pt-2 @error('nik') text-danger @enderror" for="nik">NIK <span class="text-danger">*</span></label>
                                        <div class="col-lg-6">
                                            <input type="text" name="nik" class="form-control @error('nik') is-invalid @enderror" id="nik">
                                            @error('nik')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                <div class="form-group row pb-4">
                                    <label class="col-lg-3 control-label text-lg-end pt-2 @error('phone') text-danger @enderror" for="phone">PHONE <span class="text-danger">*</span></label>
                                    <div class="col-lg-6">
                                        <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" id="phone">
                                        @error('phone')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>


                            </div>
                            <div class="col-xl-6">
                                <div class="form-group row pb-4">
                                    <label class="col-lg-3 control-label text-lg-end pt-2 @error('email') text-danger @enderror" for="email">EMAIL <span class="text-danger">*</span></label>
                                    <div class="col-lg-6">
                                        <div class="input-group">
													<span class="input-group-text">
														<i class="fas fa-envelope"></i>
													</span>
                                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="contoh: email@email.com" />
                                        </div>
                                        @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <footer class="card-footer">
                        <div class="row justify-content-end">
                            <div class="col-sm-9">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <a href="{{route('adm.dosen')}}"><button type="button" class="btn btn-danger">Batal</button></a>
                            </div>
                        </div>
                    </footer>
                </section>
                </form>
            </div>
        </div>
        <!-- end: page -->
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
