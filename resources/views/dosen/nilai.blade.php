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
                                                <option value="{{base64_encode($row->matkul->id)}}" @if($opsiMapel == base64_encode($row->matkul->id)) selected @endif>{{$row->matkul->name}}</option>
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
                                            <td class="text-start">{{$row->maha->mahasiswa->nim ?? ""}}</td>
                                            <td class="text-start">{{$row->maha->name ?? ""}}</td>
                                            <td class="text-center">{{$row->uts ?? 0}}</td>
                                            <td class="text-center">{{$row->uas ?? 0}}</td>
                                            <td class="text-center">{{$row->presensi ?? 0}}</td>
                                            <td class="text-center">{{$row->total ?? 0}}</td>
                                            <td class="text-center"><button class="btn btn-sm btn-primary open-nilai" data-id="{{base64_encode($row->id)}}"
                                                                            data-uts="{{$row->uts ?? 0}}"
                                                                            data-uas="{{$row->uas ?? 0}}"
                                                                            data-presensi="{{$row->presensi ?? 0}}"
                                                                            data-name="{{$row->maha->name ?? ""}}"
                                                                            data-kelas="{{base64_encode($row->maha->mahasiswa->kelas_id) ?? ""}}"
                                                                            data-mapel="{{base64_encode($row->matakuliah_id) ?? ""}}"
                                                                            data-bs-toggle="modal" data-bs-target="#modalNilai">INPUT NILAI</button></td>
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

        <!-- START : Modal HAPUS -->
        <div class="modal fade" id="modalNilai" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Simpan Nilai <span id="nama_mahasiswa" class="text-primary font-weight-bold"></span></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{route('dosen.nilai.save')}}" method="post">
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">

                                    <input type="hidden" id="usermatkul_id" class="form-control" name="usermatkul_id" value="{{old('usermatkul_id')}}">
                                    <input type="hidden" id="mapel_id" class="form-control" name="mapel_id" value="{{old('mapel_id')}}">
                                    <input type="hidden" id="kelas_id" class="form-control" name="kelas_id" value="{{old('kelas_id')}}">
                                </div>
                            </div>
                            <!-- Start: UTS -->
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="nilai_uts"
                                        @class(["form-label","errorLabel",($errors->has('nilai_uts'))? "text-danger":""]) >NILAI UTS
                                    </label>
                                    <input type="number" name="nilai_uts"
                                           @class(["form-control","errorInput",($errors->has('nilai_uts'))? "is-invalid":""]) value="{{old('nilai_uts')}}"
                                           id="nilai_uts" placeholder="0">
                                    @error('nilai_uts')
                                    <span
                                        class="text-danger errorMessage">{{$errors->first('nilai_uts')}}</span>
                                    @enderror
                                </div>
                            </div>
                            <!-- END: UTS -->

                            <!-- Start: UAS -->
                            <div class="row mt-2">
                                <div class="col-md-12">
                                    <label for="nilai_uas"
                                        @class(["form-label","errorLabel",($errors->has('nilai_uas'))? "text-danger":""]) >NILAI UAS
                                    </label>
                                    <input type="number" name="nilai_uas"
                                           @class(["form-control","errorInput",($errors->has('nilai_uas'))? "is-invalid":""]) value="{{old('nilai_uas')}}"
                                           id="nilai_uas" placeholder="0">
                                    @error('nilai_uas')
                                    <span
                                        class="text-danger errorMessage">{{$errors->first('nilai_uas')}}</span>
                                    @enderror
                                </div>
                            </div>
                            <!-- END: UAS -->

                            <!-- Start: PRESENSI -->
                            <div class="row mt-2">
                                <div class="col-md-12">
                                    <label for="nilai_presensi"
                                        @class(["form-label","errorLabel",($errors->has('nilai_presensi'))? "text-danger":""]) >NILAI PRESENSI
                                    </label>
                                    <input type="number" name="nilai_presensi"
                                           @class(["form-control","errorInput",($errors->has('nilai_presensi'))? "is-invalid":""]) value="{{old('nilai_presensi')}}"
                                           id="nilai_presensi" placeholder="0">
                                    @error('nilai_presensi')
                                    <span
                                        class="text-danger errorMessage">{{$errors->first('nilai_presensi')}}</span>
                                    @enderror
                                </div>
                            </div>
                            <!-- END: PRESENSI -->

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-success">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- END : Modal HAPUS -->



    @push('customJS')
        <!-- Specific Page Vendor -->
        <script src="{{asset('template/vendor/pnotify/pnotify.custom.js')}}"></script>
        <x-admin.toast-message/>
        <script>
            $(document).ready(function () {
                /** saat tombol tambah nilai di klik */
                $(document).on("click", ".open-nilai", function (e) {
                    e.preventDefault();
                    let fid = $(this).data('id');
                    let fuas = $(this).data('uas');
                    let futs = $(this).data('uts');
                    let fpresensi = $(this).data('presensi');
                    let fmapel = $(this).data('mapel');

                    let fnama = $(this).data('name');
                    let fkelas = $(this).data('kelas');
                    $('#nilai_uts').val(futs);
                    $('#nama_mahasiswa').html(fnama);
                    $('#nilai_uas').val(fuas);
                    $('#nilai_presensi').val(fuas);
                    $('#nilai_presensi').val(fpresensi);
                    $('#usermatkul_id').val(fid);
                    $('#mapel_id').val(fmapel);
                    $('#kelas_id').val(fkelas);
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
            });
        </script>
    @endpush
</x-admin.template-admin>
