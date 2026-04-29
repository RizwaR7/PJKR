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
                        style="background: linear-gradient(-90deg, #0d5959 0%, #016666 100%);">Kelola Footer
                    </h4>
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <button type="button" class="btn btn-primary  btn-fw" data-toggle="modal" data-target="#modalDelete_Tambah"><i class="fa fa-plus"></i> Tambah</button>
                    </div>
                    <div class="table-responsive p-3">
                        <table class="table table-bordered table-hover table-striped table-flush table-sm tb-menu-utama"
                            id="dataTable" width="100%" cellspacing="0">
                            <thead class="thead-light">
                                <tr class="text-center align-items-center">
                                    <th>Icon</th>
                                    <th>Nama Menu Utama</th>
                                    <th>Nomor Urut</th>
                                    <th>Link Tujuan</th>
                                    <th>Status</th>
                                    <th>Jenis</th>
                                    <th>New Tab</th>
                                    <th>Tindakan/Aksi </th>
                                </tr>
                            </thead>
                            @foreach($footers as $f)
                                <tr>
                                    <td class="text-center">
                                        <img src="{{ asset('/assets/images/footer_icon/' . $f->icon_key.'.svg')}}" width="16" height="16">
                                    </td>
                                    <td class="text-left">{{ $f->nama }}</td>
                                    <td class="text-left">{{ $f->urut }}</td>
                                    <td class="text-left">{{ $f->url }}</td>
                                    @if($f->aktif  == '1')
                                        <td class ="text-center">Ya</td>
                                    @else
                                        <td class ="text-center">Tidak</td>
                                    @endif
                                    <td class="text-left">{{ $f->jenis }}</td>
                                    @if($f->newtab  == '1')
                                        <td class ="text-center">Ya</td>
                                    @else
                                        <td class ="text-center">Tidak</td>
                                    @endif
                                    <td class="text-left">
                                        <a data-target="#modalEdit_{{ $f->id }}" class="btn btn-warning btn-sm edit" data-toggle="modal" title="Edit Footer">
                                            <i class="fas fa-edit text-white"></i>
                                        </a>
                                        <a data-toggle="modal" data-target="#modalDelete_{{ $f->id }}" class="btn btn-danger btn-sm text-white" >
                                            <i class="fas fa-trash  text-center"></i>
                                        </a>

<!-- Modal Edit Footer -->
<div class="modal fade" id="modalEdit_{{ $f->id }}" tabindex="-1" role="dialog" aria-labelledby="modalEditLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditLabel">Edit Footer</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ route('footer.update', $f->id) }}">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama">Nama Footer</label>
                        <input type="text" class="form-control" id="nama_{{ $f->id }}" name="nama" value="{{ $f->nama }}" required>
                    </div>
                    <div class="form-group">
                        <label for="urut">Nomor Urut</label>
                        <input type="number" class="form-control" id="urut_{{ $f->id }}" name="urut" value="{{ $f->urut }}" required>
                    </div>
                    <div class="form-group">
                        <label for="url">Link</label>
                        <input type="text" class="form-control" id="url_{{ $f->id }}" name="url" value="{{ $f->url }}" required>
                    </div>
                    <div class="form-group">
                        <label for="aktif">Status</label>
                        <select class="form-control" id="aktif_{{ $f->id }}" name="aktif" required>
                            <option value="1" {{ $f->aktif == '1' ? 'selected' : '' }}>Aktif</option>
                            <option value="0" {{ $f->aktif == '0' ? 'selected' : '' }}>Nonaktif</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="jenis">Jenis</label>
                        <select class="form-control" id="jenis_{{ $f->id }}" name="jenis" required>
                            <option value="link" {{ $f->jenis == 'link' ? 'selected' : '' }}>Link</option>
                            <option value="kontak" {{ $f->jenis == 'kontak' ? 'selected' : '' }}>Kontak</option>
                            <option value="lokasi" {{ $f->jenis == 'lokasi' ? 'selected' : '' }}>Lokasi</option>
                            <option value="gambar" {{ $f->jenis == 'gambar' ? 'selected' : '' }}>Gambar</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="icon">Icon [Preview: <img id="icon_preview_{{ $f->id }}" src="{{ asset('/assets/images/footer_icon/' . $f->icon_key.'.svg')}}" width="16" height="16">]</label>
                        <select class="form-control" id="icon_{{ $f->id }}" name="icon_key" required>
                                        <option value="contact" {{ $f->icon_key == 'contact' ? 'selected' : '' }}>Kontak</option>
                                        <option value="gmail" {{ $f->icon_key == 'gmail' ? 'selected' : '' }}>Gmail</option>
                                        <option value="location" {{ $f->icon_key == 'location' ? 'selected' : '' }}>Lokasi</option>
                                        <option value="instagram" {{ $f->icon_key == 'instagram' ? 'selected' : '' }}>Instagram</option>
                                        <option value="facebook" {{ $f->icon_key == 'facebook' ? 'selected' : '' }}>Facebook</option>
                                        <option value="twitter" {{ $f->icon_key == 'twitter' ? 'selected' : '' }}>Twitter/X</option>
                                        <option value="linkedin" {{ $f->icon_key == 'linkedin' ? 'selected' : '' }}>Linkedin</option>
                                        <option value="whatsapp" {{ $f->icon_key == 'whatsapp' ? 'selected' : '' }}>Whatsapp</option>
                                        <option value="" {{ isset($f->icon_key )? '' : 'selected' }}>Tidak ada</option>
                        </select>
                    </div>
                        <script>
                                    $(document).ready(function() {
                                        $('#icon_{{ $f->id }}').change(function() {
                                            var icon = $('#icon_{{ $f->id }}').val();
                                            if (icon == 'url') {
                                                $('#icon_preview_{{ $f->id }}').attr("src", "{{ asset('/assets/images/footer_icon/url.svg')}}");
                                            } else if (icon == 'contact') {
                                                $('#icon_preview_{{ $f->id }}').attr("src", "{{ asset('/assets/images/footer_icon/contact.svg')}}");
                                            } else if (icon == 'gmail') {
                                                $('#icon_preview_{{ $f->id }}').attr("src", "{{ asset('/assets/images/footer_icon/gmail.svg')}}");
                                            } else if (icon == 'location') {
                                                $('#icon_preview_{{ $f->id }}').attr("src", "{{ asset('/assets/images/footer_icon/location.svg')}}");
                                            } else if (icon == 'instagram') {
                                                $('#icon_preview_{{ $f->id }}').attr("src", "{{ asset('/assets/images/footer_icon/instagram.svg')}}");
                                            }else if (icon == 'facebook') {
                                                $('#icon_preview_{{ $f->id }}').attr("src", "{{ asset('/assets/images/footer_icon/facebook.svg')}}");
                                            }else if (icon == 'twitter') {
                                                $('#icon_preview_{{ $f->id }}').attr("src", "{{ asset('/assets/images/footer_icon/twitter.svg')}}");
                                            }else if (icon == 'linkedin') {
                                                $('#icon_preview_{{ $f->id }}').attr("src", "{{ asset('/assets/images/footer_icon/linkedin.svg')}}");
                                            }else if (icon == 'whatsapp') {
                                                $('#icon_preview_{{ $f->id }}').attr("src", "{{ asset('/assets/images/footer_icon/whatsapp.svg')}}");
                                            }else {
                                                $('#icon_preview_{{ $f->id }}').attr("src", "");
                                            }
                                        });
                                    });
                                </script>
                    <div class="form-group">
                        <label for="newtab">New Tab</label>
                        <select class="form-control" id="newtab_{{ $f->id }}" name="newtab" required>
                            <option value="1" {{ $f->newtab == '1' ? 'selected' : '' }}>Ya</option>
                            <option value="0" {{ $f->newtab == '0' ? 'selected' : '' }}>Tidak</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>


                                        <!-- Modal Hapus-->
                                        <form action="{{ route('footer.destroy', $f->id)}}" method="post">
                                            <div class="modal fade" id="modalDelete_{{ $f->id }}" tabindex="-1" role="dialog" aria-labelledby="modalDeleteLabel" aria-hidden="true">
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

                                                            <p>Apakah anda yakin ingin menghapus data <b>{{$f->nama}}</b> ?</p>

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
                    <form method="POST" action="{{ route('footer.store') }}">
                        <div class="modal-body">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <input type="hidden" class="form-control" id="id" name="id">
                                </div>
                                <div class="form-group">
                                    <label for="nama_footer">Nama Footer</label>
                                    <input type="text" class="form-control" id="nama" name="nama"
                                        placeholder="Nama Footer" required>
                                </div>
                                <div class="form-group">
                                    <label for="nomor_urut">Nomor Urut</label>
                                    <input type="number" class="form-control" id="urut" name="urut"
                                        placeholder="Nomor Urut" required>
                                </div>
                                <div class="form-group">
                                    <label for="link">Link</label>
                                    <small class="form-text badge bg-danger text-white">
                                        Jangan menggunakan _ (underscore) pada link
                                    </small>

                                    <input type="text" class="form-control" id="url" name="url"
                                        value="https://" required>
                                </div>
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select class="form-control" id="aktif" name="aktif" required>
                                        <option value="1">Aktif</option>
                                        <option value="0">Nonaktif</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="jenis">Jenis</label>
                                    <select class="form-control" id="jenis" name="jenis" required>
                                        <option value="link">Link</option>
                                        <option value="kontak">Kontak</option>
                                        <option value="lokasi">Lokasi</option>
                                        <option value="gambar">Gambar</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="icon" id>Icon [Preview: <img id="icon_preview" src="" width="16" height="16">]</label>
                                    <select class="form-control" id="icon" name="icon_key" required>
                                        <option value="url">URL</option>
                                        <option value="contact">Kontak</option>
                                        <option value="gmail">Gmail</option>
                                        <option value="location">Lokasi</option>
                                        <option value="instagram">Instagram</option>
                                        <option value="facebook">Facebook</option>
                                        <option value="twitter">Twitter/X</option>
                                        <option value="linkedin">Linkedin</option>
                                        <option value="whatsapp">Whatsapp</option>
                                        <option value="" selected>Tidak ada</option>
                                    </select>
                                </div>
                                <script>
                                    $(document).ready(function() {
                                        $('#icon').change(function() {
                                            var icon = $('#icon').val();
                                            if (icon == 'url') {
                                                $('#icon_preview').attr("src", "{{ asset('/assets/images/footer_icon/url.svg')}}");
                                            } else if (icon == 'contact') {
                                                $('#icon_preview').attr("src", "{{ asset('/assets/images/footer_icon/contact.svg')}}");
                                            } else if (icon == 'gmail') {
                                                $('#icon_preview').attr("src", "{{ asset('/assets/images/footer_icon/gmail.svg')}}");
                                            } else if (icon == 'location') {
                                                $('#icon_preview').attr("src", "{{ asset('/assets/images/footer_icon/location.svg')}}");
                                            } else if (icon == 'instagram') {
                                                $('#icon_preview').attr("src", "{{ asset('/assets/images/footer_icon/instagram.svg')}}");
                                            }else if (icon == 'facebook') {
                                                $('#icon_preview').attr("src", "{{ asset('/assets/images/footer_icon/facebook.svg')}}");
                                            }else if (icon == 'twitter') {
                                                $('#icon_preview').attr("src", "{{ asset('/assets/images/footer_icon/twitter.svg')}}");
                                            }else if (icon == 'linkedin') {
                                                $('#icon_preview').attr("src", "{{ asset('/assets/images/footer_icon/linkedin.svg')}}");
                                            }else if (icon == 'whatsapp') {
                                                $('#icon_preview').attr("src", "{{ asset('/assets/images/footer_icon/whatsapp.svg')}}");
                                            }else {
                                                $('#icon_preview').attr("src", "");
                                            }
                                        });
                                    });
                                </script>
                                <div class="form-group">
                                    <label for="new_tab">New Tab</label>
                                    <select class="form-control" id="newtab" name="newtab" required>
                                        <option value="1">Ya</option>
                                        <option value="0">Tidak</option>
                                    </select>
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

    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript">
    $(document).ready(function() {
       
        $('form').on('submit', function(event) {
            event.preventDefault();
            let form = $(this);
            let formData = form.serialize();
            let url = form.attr('action');
            let method = form.attr('method');

            $.ajax({
                url: url,
                type: method,
                data: formData,
                success: function(response) {
                    if (method === 'PUT') {
                        $('#modalEdit_' + response.id).modal('hide');
                    } else if (method === 'POST') {
                        $('#modalDelete_Tambah').modal('hide');
                    }
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: 'Data berhasil disimpan!',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => {
                        location.reload();
                    });
                },
                error: function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Terjadi kesalahan, coba lagi!',
                    });
                }
            });
        });

        $('.delete-form').on('submit', function(event) {
            event.preventDefault();
            let form = $(this);
            let url = form.attr('action');

            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data yang dihapus tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: url,
                        type: 'DELETE',
                        data: form.serialize(),
                        success: function(response) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: 'Data berhasil dihapus!',
                                showConfirmButton: false,
                                timer: 1500
                            }).then(() => {
                                location.reload();
                            });
                        },
                        error: function() {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Terjadi kesalahan, coba lagi!',
                            });
                        }
                    });
                }
            });
        });
    });
</script>
@endsection
