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
                    <li><span>Mata Pelajaran</span></li>
                </ol>
            </div>
            <h2 class="font-weight-semibold">Mata Pelajaran</h2>
        </header>

        <!-- start: page -->
        <div class="row">
            <div class="col-lg-12 mb-3">
                <section class="card">
                    <header class="card-header">
                        <div class="card-actions">
                            <button class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#modalTambah"><i class='bx bx-duplicate'></i></button>
                        </div>
                        <h2 class="card-title">Mata Pelajaran</h2>
                    </header>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xl-12">
                                <table id="tabel1" class="table table-bordered table-striped mb-0" style="width: 100%">
                                    <thead>
                                    <tr>
                                        <th scope="col" class="text-center">#</th>
                                        <th scope="col" class="text-center">KODE</th>
                                        <th scope="col" class="text-center">NAMA</th>
                                        <th scope="col" class="text-center">SKS</th>
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
    <!-- START : Modal TAMBAH -->
    <div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{route('adm.mapel.save')}}" method="post">
                    @csrf
                    <div class="modal-body">
                        <!-- Start: Code -->
                        <div class="row mt-2">
                            <div class="col-md-12">
                                <label for="code"
                                    @class(["form-label","errorLabel",($errors->has('code'))? "text-danger":""]) >KODE
                                    MATA KULIAH
                                </label>
                                <input type="text" name="code" maxlength="125"
                                       @class(["form-control","errorInput",($errors->has('code'))? "is-invalid":""]) value="{{old('code')}}"
                                       id="code" placeholder="Kode Mata Kuliah">
                                @if($errors->has('code'))
                                    <span
                                        class="text-danger errorMessage">{{$errors->first('code')}}</span>
                                @endif
                            </div>
                        </div>
                        <!-- End: Code -->


                        <!-- Start: Name -->
                        <div class="row mt-2">
                            <div class="col-md-12">
                                <label for="name"
                                    @class(["form-label","errorLabel",($errors->has('name'))? "text-danger":""]) >NAMA
                                    MATA KULIAH
                                </label>
                                <input type="text" name="name" maxlength="125"
                                       @class(["form-control","errorInput",($errors->has('name'))? "is-invalid":""]) value="{{old('name')}}"
                                       id="name" placeholder="Nama Mata Kuliah">
                                @error('name')
                                <span
                                    class="text-danger errorMessage">{{$errors->first('name')}}</span>
                                @enderror
                            </div>
                        </div>
                        <!-- End: Name -->

                        <!-- Start: SKS -->
                        <div class="row mt-2">
                            <div class="col-md-12">
                                <label for="sks"
                                    @class(["form-label","errorLabel",($errors->has('sks'))? "text-danger":""]) >JUMLAH
                                    SKS
                                </label>
                                <select name="sks"
                                        id="sks" @class(["form-control","errorInput",($errors->has('sks'))? "is-invalid":""]) >
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                </select>
                                @if($errors->has('sks'))
                                    <span
                                        class="text-danger errorMessage">{{$errors->first('sks')}}</span>
                                @endif
                            </div>
                        </div>
                        <!-- End: SKS -->


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- END : Modal TAMBAH -->

    <!-- START : Modal EDIT -->
    <div class="modal fade" id="modalEdit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{route('adm.mapel.update')}}" method="post">
                    @csrf
                    @method('patch')
                    <div class="modal-body">
                        <!-- Start: Code -->
                        <div class="row">
                            <div class="col-md-12">
                                <input type="hidden" id="mapel_id" name="mapel_id" value="{{old('mapel_id')}}">
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-12">
                                <label for="codeEdit"
                                    @class(["form-label","errorLabel",($errors->has('code'))? "text-danger":""]) >KODE
                                    MATA KULIAH
                                </label>
                                <input type="text" name="code" maxlength="125"
                                       @class(["form-control","errorInput",($errors->has('code'))? "is-invalid":""]) value="{{old('code')}}"
                                       id="codeEdit" placeholder="Kode Mata Kuliah">
                                @if($errors->has('code'))
                                    <span
                                        class="text-danger errorMessage">{{$errors->first('code')}}</span>
                                @endif
                            </div>
                        </div>
                        <!-- End: Code -->


                        <!-- Start: Name -->
                        <div class="row mt-2">
                            <div class="col-md-12">
                                <label for="nameEdit"
                                    @class(["form-label","errorLabel",($errors->has('name'))? "text-danger":""]) >NAMA
                                    MATA KULIAH
                                </label>
                                <input type="text" name="name" maxlength="125"
                                       @class(["form-control","errorInput",($errors->has('name'))? "is-invalid":""]) value="{{old('name')}}"
                                       id="nameEdit" placeholder="Nama Mata Kuliah">
                                @error('name')
                                <span
                                    class="text-danger errorMessage">{{$errors->first('name')}}</span>
                                @enderror
                            </div>
                        </div>
                        <!-- End: Name -->

                        <!-- Start: SKS -->
                        <div class="row mt-2">
                            <div class="col-md-12">
                                <label for="sksEdit"
                                    @class(["form-label","errorLabel",($errors->has('sks'))? "text-danger":""]) >JUMLAH
                                    SKS
                                </label>
                                <select name="sks"
                                        id="sksEdit" @class(["form-control","errorInput",($errors->has('sks'))? "is-invalid":""]) >
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                </select>
                                @if($errors->has('sks'))
                                    <span
                                        class="text-danger errorMessage">{{$errors->first('sks')}}</span>
                                @endif
                            </div>
                        </div>
                        <!-- End: SKS -->


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- END : Modal EDIT -->

    <!-- START : Modal HAPUS -->
    <div class="modal fade" id="modalHapus" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Hapus Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{route('adm.mapel.delete')}}" method="post">
                    @csrf
                    @method('delete')
                    <div class="modal-body">
                        <!-- Start: Code -->
                        <div class="row">
                            <div class="col-md-12">
                                <input type="hidden" id="mapelhapus_id" name="mapel_id" value="{{old('mapel_id')}}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                Apakah anda ingin menghapus data ini ?
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger">Hapus</button>
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
                        {data: 'code', class: 'text-center'},
                        {data: 'name', class: 'text-left'},
                        {data: 'sks', class: 'text-center', orderable: false},
                        {data: 'action', class: 'text-center', orderable: false},
                    ],
                    "bDestroy": true
                });
            });
        </script>
    @endpush
</x-admin.template-admin>
