@extends('admin_side.layout.app')

@section('content')
<style>
  .video-container {
    position: relative;
    height: 0;
    width: 560px;
    height: 315px;
    overflow: hidden;
    background: #000;
    border-radius: 25px;
    /* box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5); */
  }

  iframe,
  video {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    border-radius: 25px;
  }

  .unsupported-message {
    color: red;
    font-size: 18px;
    text-align: center;
    margin-top: 10px;
  }
</style>
<!-- Container Fluid-->
<div class="container-fluid" id="container-wrapper">
  <!-- Row -->
  <div class="row">
    <div class="col-lg-12">
      <div class="card mb-4">
        <h4 class="card-header font-weight-bold text-white text-center"
          style="background: linear-gradient(-90deg, #0d5959 0%, #016666 100%);">Kelola Video
        </h4>
        <div class="card-body">
          <div class="alert alert-warning d-inline-block mt-1" role="alert">
            <i class="fas fa-info-circle mr-2"></i> Jika video tidak tampil atau muncul popup download, ganti URL videonya.
          </div>
          <br>
          <div class="row justify-content-around">
            <!-- Kolom untuk preview video, desc, nama -->
            <div class="d-flex align-items-center justify-content-center">
              <div class="card" style="width: 100%;">
                <div class="card-body text-center">
                  <h5 class="card-title mt-3">Preview Video</h5>
                  <div class="text-center">
                    <div class="video-container text-center">
                      <div id="video-wrapper"></div>
                      <div id="unsupported-message" class="unsupported-message" style="display: none; color: red;">
                        Format video tidak didukung.
                      </div>
                    </div>
                    <div id="noConnectionMessage" style="display: none; color: red; font-size: 18px; margin-top: 10px;">
                      Tidak ada koneksi internet. Silakan coba lagi nanti.
                    </div>
                  </div>
                </div>
              </div>

            </div>
            <!-- Kolom untuk form -->
            <div class="col-md-5 d-flex flex-column">
              <form id="formCommon" class="formCommon">
                <input type="hidden" name="id" value="{{ isset($video) ? $video->id : '' }}">
                <div class="form-group">
                  <label for="name">Nama Video</label>
                  <input type="text" class="form-control" id="name" name="name" placeholder="Masukkan Nama Video" value="{{ isset($video) ? $video->name : '' }}">
                </div>
                <div class="form-group">
                  <label for="url">URL Video</label>
                  <input type="text" class="form-control" id="url" name="url" placeholder="Masukkan URL Video" value="{{ isset($video) ? $video->url : '' }}">
                </div>
                <div class="form-group">
                  <label for="desc">Deskripsi Video</label>
                  <textarea class="form-control" id="desc" name="desc" rows="3" placeholder="Masukkan Deskripsi Video">{{ isset($video) ? $video->desc : ''  }}</textarea>
                </div>
                <div class="input-group-append d-flex justify-content">
                  <button class="btn btn-success mt-2 saveBtn" id="saveBtn" type="submit">Simpan</button>
                </div>
              </form>
            </div>
          </div>
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
  <script type="text/javascript" type="text/javascript" type="text/javascript">
    function isVideoFormatSupported(url) {
      const videoType = getVideoType(url);
      if (videoType === "youtube" || videoType === "vimeo") {
        return true;
      } else {
        const mimeType = getMimeType(url);
        return mimeType !== null;
      }
    }

    function getVideoType(url) {
      if (url.includes("youtube.com") || url.includes("youtu.be")) {
        const videoId = url.match(/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/ ]{11})/)?.[1];
        if (videoId) return "youtube";
      } else if (url.includes("vimeo.com")) {
        return "vimeo";
      } else {
        return "html";
      }
    }

    function getMimeType(url) {
      const extension = url.split(".").pop().toLowerCase();
      const mimeTypes = {
        "mp4": "video/mp4",
        "webm": "video/webm",
        "ogg": "video/ogg",
        "mkv": "video/x-matroska",
        "mov": "video/quicktime",
      };
      return mimeTypes[extension] || null;
    }

    function loadVideo(url) {
      const videoType = getVideoType(url);
      const wrapper = document.getElementById("video-wrapper");
      const unsupportedMessage = document.getElementById("unsupported-message");

      wrapper.innerHTML = "";
      unsupportedMessage.style.display = "none";

      if (videoType === "youtube") {
        const videoId = url.match(/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/ ]{11})/)?.[1];
        wrapper.innerHTML = `<iframe src="https://www.youtube.com/embed/${videoId}?autoplay=0&rel=0"
                frameborder="0" allow="autoplay; encrypted-media" allowfullscreen>
            </iframe>`;
      } else if (videoType === "vimeo") {
        const videoId = url.match(/vimeo\.com\/(\d+)/)[1];
        wrapper.innerHTML = `<iframe src="https://player.vimeo.com/video/${videoId}?autoplay=0"
                frameborder="0" allow="autoplay; fullscreen; encrypted-media" allowfullscreen>
            </iframe>`;
      } else {
        const mimeType = getMimeType(url);
        if (mimeType) {
          wrapper.innerHTML = `<video controls src="${url}">
                    Your browser does not support the video tag.
                </video>`;
          const player = new Plyr();

          if (!player.supported.ui) {
            wrapper.innerHTML = "";
            unsupportedMessage.style.display = "block";
          }
        } else {
          unsupportedMessage.style.display = "block";
        }
      }
    }

    const videoUrl = "{{ isset($video) ? $video->url : '' }}";
    if (videoUrl) {
      loadVideo(videoUrl);
    }
    $.ajaxSetup({
      headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
      },
    });

    $('#saveBtn').click((e) => {

      const videoUrl = $("#url").val(); // Ganti dengan ID input URL video Anda
      e.preventDefault();

      if (!isVideoFormatSupported(videoUrl)) {
        Swal.fire({
          title: "Format Tidak Didukung",
          text: "Format video yang dimasukkan tidak didukung.",
          icon: 'error',
          confirmButtonText: 'Ok'
        });
        return; // Batalkan pengiriman jika format tidak didukung
      }
      $.ajax({
        data: new FormData($("#formCommon")[0]),
        processData: false,
        contentType: false,
        url: "{{ route('kelola_video.store') }}",
        type: "POST",
        dataType: "json",
        success: function(data) {
          Swal.fire({
            title: data.title,
            text: data.message,
            icon: 'success',
            confirmButtonText: 'Ok'
          });
          $("#formCommon").trigger("reset");
          location.reload();
        },
        error: function(data) {
          var errorText = JSON.parse(data.responseText).message;
          Swal.fire({
            title: data.title,
            text: errorText,
            icon: 'error',
            confirmButtonText: 'Ok'
          });
          console.log("Error:", data);
        },
      });
    });
  </script>
  @endsection
