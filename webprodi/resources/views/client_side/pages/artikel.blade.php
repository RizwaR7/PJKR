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
                            placeholder="Cari Artikel" value="{{ request('query') }}" style="width: auto;">
                    </form>
                </div>
            </div>
        </div>
        <div class="section_berita row">
            <br>
            <!-- Main Post Section -->
            <div class="col-lg-8">
                @foreach ($all as $artikel)
                <div class="featured-post mb-4 card">
                    <a href="{{ route('detail_artikel.index', ['id' =>  $artikel->id]) }}" class="newsdesk" style="color: inherit;">
                        <!-- @if (is_null($artikel->foto_berita))
                        <h1>NO IMAGE</h1>
                        @elseif ($artikel->foto_berita)
                        <img src="{{ $artikel->foto_berita }}" class="img-fluid card-img-top banner-img" style="display: block;object-fit: cover;object-position: center;height: 100%;max-height: 200px;width: 100%;">
                        @endif -->
                        <p class="h5">{{ $artikel->judul }}</p>
                        <p>{{ \Carbon\Carbon::createFromTimestamp($artikel->ts)->format('F d, Y') }}
                            <span>
                                <span
                                    class="badge md-badge badge-{{ $artikel->jenis == 'Berita' ? 'primary' : ($artikel->jenis == 'Kegiatan' ? 'secondary' : ($artikel->jenis == 'Pengumuman' ? 'success' : 'danger')) }} text-white">{{ $artikel->jenis }}</span>
                                <span class="badge md-badge ml-2 badge-info text-white">{{ $artikel->counters }}
                                    Dilihat</span>
                            </span>
                        </p>
                        <p>{{ Str::limit(strip_tags($artikel->isi), 100) }}</p>
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
                    url: "{{ route('artikel.index') }}",
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
