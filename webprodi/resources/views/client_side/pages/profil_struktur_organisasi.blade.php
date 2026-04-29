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
        <div class="featured-post mb-4 card">
          <div class="newsdesks">
            <img src="{{ asset('assets/images/struktur-organisasi/'. env('PRODI_ID') . '.jpg') }}" alt="Struktur Organisasi"
              class="img-fluid">
          </div>
        </div>
        <!-- Pagination Links -->
      </div>

      <!-- Sidebar -->
        @include('client_side.layout.sidebar')  
    </div>
  </div>

</div>

<script src="{{ asset('client_side/js/custom-script.js') }}"></script>
@endsection
