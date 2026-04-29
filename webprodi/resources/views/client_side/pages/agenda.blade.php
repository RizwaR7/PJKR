@extends('client_side.layout.app')

@section('content')
<link rel="stylesheet" href="{{ asset('client_side/css/berita.css?v=') . time() }}" />

<!-- Page-->
<div class="page">
    <!-- Header-->
    @include('client_side.layout.header')

    <!-- Main Content -->
    <div class="container">
        <div class="textheader">
            <div class="row justify-content mt-3">
                <div class="col-md-8 col-lg-6">
                    <form action="{{ route('agenda.index') }}" method="GET" class="d-flex" id="searchForm">
                        <input type="text" name="query" id="searchInput" class="form-control flex-grow-1"
                            placeholder="Cari Agenda" value="{{ request('query') }}" style="width: auto;">
                    </form>

                </div>
            </div>
        </div>
        <div class="section_agenda row" style="width: 100%;">
            <!-- Main Post Section -->
            <div class="col-lg-8">
                @foreach ($agenda as $agendas)
                <div class="featured-post mb-4 card">
                    <a href="{{ route('detail_agenda.index', ['id' =>  $agendas->id_kegiatan]) }}" class="newsdesk" style="color: inherit;">
                        <p class="h5">{{ $agendas->judul_kegiatan }}</p>
                        <p>{{ \Carbon\Carbon::createFromTimestamp($agendas->ts)->format('F d, Y') }}
                            <span>
                                <span class="badge md-badge badge-warning text-white">Agenda</span>
                                <span class="badge md-badge badge-info text-white">{{ $agendas->counters }} Dilihat</span>
                                <span class="badge sm-badge badge-secondary text-white "> {{ $agendas->tempat_kegiatan }}</span>
                            </span>
                        </p>
                        <p>{{ Str::limit(strip_tags($agendas->isi_kegiatan), 100) }}</p>
                    </a>
                </div>
                @endforeach
                <!-- Pagination Links -->
                {{ $agenda->links('pagination::bootstrap-4') }}
            </div>

            <!-- Sidebar -->
            @include('client_side.layout.sidebar')
        </div>
    </div>

</div>

<script src="{{ asset('client_side/js/custom-script.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        let delayTimer;

        $('#searchInput').on('input', function() {
            clearTimeout(delayTimer);
            let query = $(this).val();

            delayTimer = setTimeout(function() {
                $.ajax({
                    url: "{{ route('agenda.index') }}",
                    type: "GET",
                    data: {
                        query: query
                    },
                    success: function(response) {
                        $('.section_agenda').html($(response).find('.section_agenda').html());
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
