@extends('client_side.layout.app')

@section('content')
<link rel="stylesheet" href="{{ asset('client_side/css/berita.css?v=') . time() }}" />

<!-- Page-->
<div class="page">
    @include('client_side.layout.header')

    <!-- Main Content -->
    <div class="container">
        <div class="textheader" style="width: 100%;">
        </div>
        <div class="section_berita row">
            <!-- Main Post Section -->
            <div class="col-lg-8">

                <div class="featured-posts mb-4 card">
                    <table class="table table-hover table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>FOTO</th>
                                <th>Nama</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($get_dosen as $dosen)
                            <tr onclick="showModal('{{ $dosen->foto_dosen }}', '{{ $dosen->nidn }}', '{{ $dosen->nip }}', '{{ $dosen->nama_dosen }}', '{{ $dosen->jenis_kelamin }}', '{{ $dosen->nama_ikatan_kerja }}', '{{ $dosen->email_sister }}', '{{ $dosen->scholar_id }}', '{{ $dosen->sinta_id }}', '{{ $dosen->sister_id }}', '{{ $dosen->nama_golongan}}')" style="cursor: pointer">
                                <td style="width: 100px; text-align: center;">
                                    @if (!empty($dosen->foto_dosen))
                                        <img src="/{{ $dosen->foto_dosen }}" alt="Foto Dosen"
                                            style="width: 80px; height: 80px; object-fit: cover; object-position: top; border-radius: 50%; cursor: pointer;"
                                           />
                                    @else
                                        <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" fill="gray" class="bi bi-person-circle" viewBox="0 0 16 16">
                                            <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
                                            <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1"/>
                                        </svg>
                                    @endif
                                </td>
                                <td style="vertical-align: middle;">{{ $dosen->nama_dosen }}</td>
                                <td style="vertical-align: middle; text-align: center" >
                                    <button class="btn btn-success" >Detail</button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>

                <!-- Pagination Links -->
                {{ $get_dosen->links('pagination::bootstrap-4') }}
            </div>

            <!-- Sidebar -->
            @include('client_side.layout.sidebar')  
        </div>
    </div>
</div>

<!-- Modal for Image -->

<div id="imageModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content rounded-lg shadow-lg">
            <div class="modal-header bg-success text-white rounded-top">
                <h5 class="modal-title">Foto Dosen</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body d-flex align-items-center  p-4" style="max-height: 90vh; overflow-y: auto; flex-wrap: wrap; justify-content: center; gap: 1rem;">
                <div class="mr-4 flex-shrink-0" style="width: 40%; border-radius: 20px; overflow: hidden; text-align: center;">
                        <img id="modalImage" src="{{ $dosen->foto_dosen }}" alt="Foto Dosen" class="img-fluid shadow-sm w-100" style="max-height: 100%; object-fit: cover;">
                        <svg id="ifNoImage" xmlns="http://www.w3.org/2000/svg" fill="gray" class="bi bi-person-circle" viewBox="0 0 16 16" width="100%" height="100%">
                            <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
                            <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1"/>
                        </svg>
                </div>
                <div class="dosen-details border p-4 rounded flex-grow-1 bg-white shadow-sm">
                    <table class="table table-hover table-bordered mb-0">
                        <tbody>
                            <tr>
                                <th class="bg-success text-white">NIDN</th>
                                <td id="nidn" class="font-weight-bold"></td>
                            </tr>
                            <tr>
                                <th class="bg-success text-white">NIP</th>
                                <td id="nip" class="font-weight-bold">1</td>
                            </tr>
                            <tr>
                                <th class="bg-success text-white">Nama Dosen</th>
                                <td id="nama_dosen" class="font-weight-bold"></td>
                            </tr>
                            <tr>
                                <th class="bg-success text-white">Jenis Kelamin</th>
                                <td id="jenis_kelamin" class="font-weight-bold"></td>
                            </tr>
                            <tr>
                                <th class="bg-success text-white">Nama Ikatan Kerja</th>
                                <td id="nama_ikatan_kerja" class="font-weight-bold"></td>
                            </tr>
                            <tr>
                                <th class="bg-success text-white">Nama Golongan</th>
                                <td id="nama_golongan" class="font-weight-bold"></td>
                            </tr>
                            <tr>
                                <th class="bg-success text-white">Email</th>
                                <td id="email_sister" class="font-weight-bold"></td>
                            </tr>
                            <tr>
                                <th class="bg-success text-white">Scholar ID</th>
                                <td id="scholar_id" class="font-weight-bold"></td>
                            </tr>
                            <tr>
                                <th class="bg-success text-white">Sinta ID</th>
                                <td id="sinta_id" class="font-weight-bold"></td>
                            </tr>
                            <tr>
                                <th class="bg-success text-white">Sister ID</th>
                                <td id="sister_id" class="font-weight-bold"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    function showModal(imageSrc, nidn, nip, nama_dosen, jenis_kelamin, nama_ikatan_kerja, email_sister, scholar_id, sinta_id, sister_id, nama_golongan) {
        if (!imageSrc) {
            document.getElementById('modalImage').style.display = 'none';
            document.getElementById('ifNoImage').style.display = 'block';
        } else {
            document.getElementById('modalImage').src = '/' + imageSrc;
            document.getElementById('modalImage').style.display = 'block';
            document.getElementById('ifNoImage').style.display = 'none';
        }

        document.getElementById('nidn').innerText = nidn || '-';
        document.getElementById('nip').innerText = nip || '-';
        document.getElementById('nama_dosen').innerText = nama_dosen || '-';
        document.getElementById('jenis_kelamin').innerText = jenis_kelamin || '-';
        document.getElementById('nama_ikatan_kerja').innerText = nama_ikatan_kerja || '-';
        document.getElementById('email_sister').innerText = email_sister || '-';
        document.getElementById('scholar_id').innerText = scholar_id || '-';
        document.getElementById('sinta_id').innerText = sinta_id || '-';
        document.getElementById('sister_id').innerText = sister_id || '-';
        document.getElementById('nama_golongan').innerText = nama_golongan || '-';


        $('#imageModal').modal('show');
    }
</script>

<script src="{{ asset('client_side/js/custom-script.js') }}"></script>
@endsection
