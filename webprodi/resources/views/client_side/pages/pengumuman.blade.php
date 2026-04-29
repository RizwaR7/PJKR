@extends('client_side.layout.app')

@section('content')
<link rel="stylesheet" href="{{ asset('client_side/css/berita.css?v=') . time() }}" />

<!-- Page-->
<div class="page">
    @include('client_side.layout.header')

    <!-- Main Content -->
    <div class="container">
        <div class="textheader">
            <div class="row justify-content mt-3">
                <div class="col-md-8 col-lg-6">
                    <form action="{{ route('berita.index') }}" method="GET" class="d-flex" id="searchForm">
                        <input type="text" name="query" id="searchInput" class="form-control flex-grow-1"
                            placeholder="Cari Pengumuman" value="{{ request('query') }}" style="width: auto;">
                    </form>
                </div>
            </div>
        </div>
        <div class="section_berita row">
            <br>
            <!-- Main Post Section -->
            <div class="col-lg-8">
                @foreach ($all as $pengumuman)
                <div class="featured-post mb-4 card">
                    <a href="{{ route('detail_pengumuman.index', ['id' =>  $pengumuman->id]) }}" class="newsdesk" style="color: inherit;">
                        @if (is_null($pengumuman->foto_berita))
                        @elseif ($pengumuman->foto_berita)
                        <img src="{{ $pengumuman->foto_berita }}" class="img-fluid card-img-top banner-img" style="display: block;object-fit: cover;object-position: center;height: 100%;max-height: 200px;width: 100%;">
                        @endif
                        <p class="h5">{{ $pengumuman->judul }}</p>
                        <p>{{ \Carbon\Carbon::createFromTimestamp($pengumuman->ts)->format('F d, Y') }}
                            <span>
                                <span
                                    class="badge md-badge badge-{{ $pengumuman->jenis == 'Berita' ? 'primary' : ($pengumuman->jenis == 'Kegiatan' ? 'secondary' : ($pengumuman->jenis == 'Pengumuman' ? 'success' : 'danger')) }} text-white">{{ $pengumuman->jenis }}</span>
                                <span class="badge md-badge ml-2 badge-info text-white">{{ $pengumuman->counters }}
                                    Dilihat</span>
                            </span>
                        </p>
                        <p>{{ Str::limit(strip_tags($pengumuman->isi), 100) }}</p>
                    </a>
                </div>
                @endforeach
                <!-- Pagination Links -->
                {{ $all->links('pagination::bootstrap-4') }}
            </div>

            <!-- Sidebar -->
            @include('client_side.layout.sidebar')  
        </div>
    </div>

</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        let delayTimer;

        $('#searchInput').on('input', function() {
            clearTimeout(delayTimer);
            let query = $(this).val();

            delayTimer = setTimeout(function() {
                $.ajax({
                    url: "{{ route('pengumuman.index') }}",
                    type: "GET",
                    data: {
                        query: query
                    },
                    success: function(response) {
                        $('.section_berita').html($(response).find('.section_berita').html());
                    }
                });
            });
        });

        // Mencegah pengguna menekan tombol Enter
        $('#searchInput').on('keydown', function(event) {
            if (event.key === 'Enter') {
                event.preventDefault();
            }
        });
    });
</script>


@endsection
