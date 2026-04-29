@extends('admin_side.layout.app')

@section('content')
    {{-- Content Wrapper --}}

    <!-- Container Fluid-->
    <div class="container-fluid" id="container-wrapper">
        <!-- Row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card mb-4">
                    <h4 class="card-header font-weight-bold text-white text-center"
                        style="background: linear-gradient(-90deg, #0d5959 0%, #016666 100%);">Kelola Dosen Siter
                    </h4>
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <button type="button" class="btn btn-primary  btn-fw" data-toggle="modal" data-target="#modalDelete_Tambah"><i class="fa fa-plus"></i> Tambah</button>
                    </div>
                    <div class="table-responsive p-3">
                        <table class="table table-bordered table-hover table-striped table-flush table-sm tb-menu-utama"
                            id="dataTable" width="100%" cellspacing="0">
                            <thead class="thead-light">
                                <tr class="text-center align-items-center">
                                    <th>NIP</th>
                                    <th>NAMA DOSEN</th>
                                    <th>FAKULTAS</th>
                                    <th>PRODI</th>
                                    <th>Tindakan/Aksi </th>
                                </tr>
                            </thead>
                            @foreach($dosensiters as $d)
                                <tr>
                                    <td class="text-left">{{ $d->nip }}</td>
                                    <td class="text-left">{{ $d->nama_dosen }}</td>
                                    <td class="text-left">{{ $d->fakultas }}</td>
                                    <td class="text-left">{{ $d->nama_program_studi }}</td>
                                    <td class="text-left">
                                        <a data-toggle="modal" data-target="#modalDelete_{{ $d->id_dosen }}" class="btn btn-danger btn-sm text-white" >
                                            <i class="fas fa-trash  text-center"></i>
                                        </a>
                                        <!-- Modal Hapus-->
                                        <form action="{{ route('dosensiter.destroy', $d->id_dosen)}}" method="post">
                                            <div class="modal fade" id="modalDelete_{{ $d->id_dosen }}" tabindex="-1" role="dialog" aria-labelledby="modalDeleteLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">

                                                        <div class="modal-header bg-danger">
                                                            <h5 class="modal-title" id="exampleModalLabel">Peringatan</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>

                                                        <div class="modal-body">


                                                            @method('DELETE')
                                                            @csrf

                                                            <p>Apakah anda yakin ingin menghapus data <b>{{$d->nama_dosen}}</b> ?</p>

                                                        </div>

                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal"><i class="ti-close m-r-5 f-s-12"></i> Tutup</button>
                                                            <button type="submit" class="btn btn-danger"><i class="fa fa-trash m-r-5"></i> Hapus</button>

                                                        </div>


                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        {{-- Modal Menu Utama --}}
        <div class="modal fade" id="modalDelete_Tambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTitle"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="POST" action="{{ route('dosensiter.store') }}">
                        <div class="modal-body">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <input type="hidden" class="form-control" id="id_dosen" name="id_dosen">
                                </div>
                                <div class="form-group">
                                    <label for="nidn">nidn</label>
                                    <input type="text" class="form-control" id="nidn" name="nidn"
                                        placeholder="nidn" required>
                                </div>
                                <div class="form-group">
                                    <label for="nip">nip</label>
                                    <input type="text" class="form-control" id="nip" name="nip"
                                        placeholder="nip" required>
                                </div>
                                <div class="form-group">
                                    <label for="nik">nik</label>
                                    <input type="text" class="form-control" id="nik" name="nik"
                                        placeholder="nik" required>
                                </div>
                                <div class="form-group">
                                    <label for="nama_dosen">Nama Dosen</label>
                                    <input type="text" class="form-control" id="nama_dosen" name="nama_dosen"
                                        placeholder="Nama Dosen" required>
                                </div>
                                <div class="form-group">
                                    <label for="jenis_kelamin">jenis_kelamin </label>
                                    <input type="text" class="form-control" id="jenis_kelamin" name="jenis_kelamin"
                                        placeholder="jenis_kelamin" required>
                                </div>
                                <div class="form-group">
                                    <label for="jns_sdm">jns_sdm</label>
                                    <input type="text" class="form-control" id="jns_sdm" name="jns_sdm"
                                        placeholder="jns_sdm" required>
                                </div>
                                <div class="form-group">
                                    <label for="nama_ikatan_kerja">nama_ikatan_kerja</label>
                                    <input type="text" class="form-control" id="nama_ikatan_kerja" name="nama_ikatan_kerja"
                                        placeholder="nama_ikatan_kerja" required>
                                </div>
                                <div class="form-group">
                                    <label for="fakultas">fakultas</label>
                                    <input type="text" class="form-control" id="fakultas" name="fakultas"
                                        placeholder="fakultas" required>
                                </div>
                                <div class="form-group">
                                    <label for="nama_program_studi">nama_program_studi</label>
                                    <input type="text" class="form-control" id="nama_program_studi" name="nama_program_studi"
                                        placeholder="nama_program_studi" required>
                                </div>
                                <div class="form-group">
                                    <label for="nama_golongan">nama_golongan</label>
                                    <input type="text" class="form-control" id="nama_golongan" name="nama_golongan"
                                        placeholder="nama_golongan" required>
                                </div>
                                <div class="form-group">
                                    <label for="email">email</label>
                                    <input type="text" class="form-control" id="email" name="email"
                                        placeholder="email" required>
                                </div>
                                <div class="form-group">
                                    <label for="email_siter">email_siter</label>
                                    <input type="text" class="form-control" id="email_siter" name="email_siter"
                                        placeholder="email_siter" required>
                                </div>
                                <div class="form-group">
                                    <label for="status_keaktifan">status_keaktifan</label>
                                    <input type="text" class="form-control" id="status_keaktifan" name="status_keaktifan"
                                        placeholder="status_keaktifan" required>
                                </div>
                                <div class="form-group">
                                    <label for="status_kepegawaian">status_kepegawaian</label>
                                    <input type="text" class="form-control" id="status_kepegawaian" name="status_kepegawaian"
                                        placeholder="status_kepegawaian" required>
                                </div>
                                <div class="form-group">
                                    <label for="scholar_id">scholar_id</label>
                                    <input type="text" class="form-control" id="scholar_id" name="scholar_id"
                                        placeholder="scholar_id" required>
                                </div>
                                <div class="form-group">
                                    <label for="sinta_id">sinta_id</label>
                                    <input type="text" class="form-control" id="sinta_id" name="sinta_id"
                                        placeholder="sinta_id" required>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-save m-r-5"></i> Simpan</button>
                                </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
    <!--END Row-->
    <!---Container Fluid-->
    <style>
        .goog-te-banner-frame.skiptranslate {
            display: none;
        }
    </style>

    <script type="text/javascript">
        $(document).ready(function() {


        })
    </script>
@endsection
