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
                    <li><span>Input Nilai Mahasiswa</span></li>
                </ol>
            </div>
            <h2 class="font-weight-semibold">Mata Kuliah Kalkulus </h2>
        </header>

        <div class="row">
            <div class="col-lg-12 mb-3">
                <section class="card">

                    <div class="card-body">
                        <div class="row">
                            <div class="col-xl-12">
                                <form class="row g-4">
                                    <div class="col-auto">
                                        <label for="mapel" class="visually-hidden">Password</label>
                                        <select name="mapel" class="form-select" id="mapel" required>
                                            <option value="">Pilih Mata Kuliah</option>
                                            @foreach($dataMatakuliah as $row)
                                                <option value="{{base64_encode($row->id)}}" @if($opsiMapel == base64_encode($row->id)) selected @endif>{{$row->matkul->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-auto">
                                        <label for="kelas" class="visually-hidden">Password</label>
                                        <select name="kelas" class="form-select" id="kelas" required>
                                            <option value="">Pilih Kelas</option>
                                            @foreach($dataKelas as $kelas)
                                                <option value="{{base64_encode($kelas->id)}}" @if($opsiKelas == base64_encode($kelas->id)) selected @endif>{{$kelas->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-auto">
                                        <button type="submit" class="btn btn-primary mb-3">Search</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>

        <!-- start: page -->
        <div class="row">
            <div class="col-lg-12 mb-3">
                <section class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xl-12">
                                <table id="tabelMahasiswa" class="table table-bordered table-striped mb-0" style="width: 100%">
                                    <thead>
                                    <tr>
                                        <th scope="col" class="text-center">#</th>
                                        <th scope="col" class="text-center">NPM</th>
                                        <th scope="col" class="text-center">NAMA</th>
                                        <th scope="col" class="text-center">UTS</th>
                                        <th scope="col" class="text-center">UAS</th>
                                        <th scope="col" class="text-center">PRESENSI</th>
                                        <th scope="col" class="text-center">NILAI</th>
                                        <th scope="col" class="text-center">ACTION</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php $no = 1 @endphp
                                    @foreach($dataTabel as $row)
                                        <tr>
                                            <td class="text-center">{{$no++}}</td>
                                            <td class="text-start">{{$row->matkul->name}}</td>
                                            <td class="text-start">Mahasiswa</td>
                                            <td class="text-center">70</td>
                                            <td class="text-center">0</td>
                                            <td class="text-center">0</td>
                                            <td class="text-center">E</td>
                                            <td class="text-center"><button class="btn btn-sm btn-primary">INPUT NILAI</button></td>
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
        <!-- end: page -->
    </section>



    @push('customJS')
        <!-- Specific Page Vendor -->
        <script src="{{asset('template/vendor/pnotify/pnotify.custom.js')}}"></script>
        <x-admin.toast-message/>
        <script>
            $(document).ready(function () {
                let base_url = "{{route('adm.mapel')}}";


                /** saat tombol edit di klik */
                $(document).on("click", ".open-edit", function (e) {
                    e.preventDefault();
                    let fid = $(this).data('id');
                    let fsks = $(this).data('sks');
                    let fcode = $(this).data('code');
                    let fname = $(this).data('name');
                    $('#mapel_id').val(fid);
                    $('#codeEdit').val(fcode);
                    $('#nameEdit').val(fname);
                    $('#sksEdit').val(fsks);
                })

                /** saat tombol hapus di klik */
                $(document).on("click", ".open-hapus", function (e) {
                    e.preventDefault();
                    let fid = $(this).data('id');
                    $('#mapelhapus_id').val(fid);
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
                $('#tabelMahasiswa').DataTable();
                {{--function tabelMahasiswa(kelas_id){--}}
                {{--    --}}{{--let mapel_id = '{{}}'--}}
                {{--    $('#tabelMahasiswa').DataTable({--}}
                {{--        responsive: true,--}}
                {{--        processing: true,--}}
                {{--        serverSide: true,--}}
                {{--        ajax: {--}}
                {{--            type: 'GET',--}}
                {{--            url: base_url,--}}
                {{--            async: true,--}}
                {{--            data: {--}}
                {{--                'kelas_id' : kelas_id,--}}
                {{--                'mapel_id' : mapel_id,--}}
                {{--            }--}}
                {{--        },--}}
                {{--        language: {--}}
                {{--            processing: "Loading",--}}
                {{--        },--}}
                {{--        columns: [--}}
                {{--            {--}}
                {{--                data: 'index',--}}
                {{--                class: 'text-center',--}}
                {{--                defaultContent: '',--}}
                {{--                orderable: false,--}}
                {{--                searchable: false,--}}
                {{--                width: '5%',--}}
                {{--                render: function (data, type, row, meta) {--}}
                {{--                    return meta.row + meta.settings._iDisplayStart + 1; //auto increment--}}
                {{--                }--}}
                {{--            },--}}
                {{--            {data: 'code', class: 'text-center'},--}}
                {{--            {data: 'name', class: 'text-left'},--}}
                {{--            {data: 'sks', class: 'text-center', orderable: false},--}}
                {{--            {data: 'action', class: 'text-center', orderable: false},--}}
                {{--        ],--}}
                {{--        "bDestroy": true--}}
                {{--    });--}}
                {{--}--}}

            });
        </script>
    @endpush
</x-admin.template-admin>
