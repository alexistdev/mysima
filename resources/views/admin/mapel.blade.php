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
                                    data-bs-target="#exampleModal"><i class='bx bx-duplicate'></i></button>
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
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                <select name="sks" id="sks" @class(["form-control","errorInput",($errors->has('sks'))? "is-invalid":""]) >
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

    @push('customJS')
        <!-- Specific Page Vendor -->
        <script src="{{asset('template/vendor/pnotify/pnotify.custom.js')}}"></script>
        <x-admin.toast-message />
        <script>
            $(document).ready(function () {
                let base_url = "{{route('adm.mapel')}}";
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
                    ],
                    "bDestroy": true
                });
            });
        </script>
    @endpush
</x-admin.template-admin>
