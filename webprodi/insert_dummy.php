<?php
use Illuminate\Support\Facades\DB;
$id_sms = (int)env('PRODI_ID');

// Clean old dummy data
DB::table('menu')->where('id_sms', $id_sms)->delete();
DB::table('berita')->where('id_sms', $id_sms)->delete();

// =============================================
// MENUS - matching actual routes in web.php
// =============================================

// Parent: PROFIL
$profilId = DB::table('menu')->insertGetId([
    'id_sms' => $id_sms, 'nama' => 'PROFIL', 'url' => '#',
    'aktif' => 1, 'newtab' => 0, 'urut' => 1, 'induk' => 0, 'simbol' => ''
]);
DB::table('menu')->insert([
    ['id_sms' => $id_sms, 'nama' => 'Sejarah',              'url' => '/profil/sejarah',              'aktif' => 1, 'newtab' => 0, 'urut' => 1, 'induk' => $profilId, 'simbol' => ''],
    ['id_sms' => $id_sms, 'nama' => 'Visi & Misi',          'url' => '/profil/visi-misi',            'aktif' => 1, 'newtab' => 0, 'urut' => 2, 'induk' => $profilId, 'simbol' => ''],
    ['id_sms' => $id_sms, 'nama' => 'Struktur Organisasi',  'url' => '/profil/struktur-organisasi',  'aktif' => 1, 'newtab' => 0, 'urut' => 3, 'induk' => $profilId, 'simbol' => ''],
    ['id_sms' => $id_sms, 'nama' => 'Akreditasi',           'url' => '/profil/akreditasi',           'aktif' => 1, 'newtab' => 0, 'urut' => 4, 'induk' => $profilId, 'simbol' => ''],
]);

// Parent: AKADEMIK
$akademikId = DB::table('menu')->insertGetId([
    'id_sms' => $id_sms, 'nama' => 'AKADEMIK', 'url' => '#',
    'aktif' => 1, 'newtab' => 0, 'urut' => 2, 'induk' => 0, 'simbol' => ''
]);
DB::table('menu')->insert([
    ['id_sms' => $id_sms, 'nama' => 'Daftar Dosen',  'url' => '/dosen',  'aktif' => 1, 'newtab' => 0, 'urut' => 1, 'induk' => $akademikId, 'simbol' => ''],
]);

// Parent: KEMAHASISWAAN
$mahasiswaId = DB::table('menu')->insertGetId([
    'id_sms' => $id_sms, 'nama' => 'KEMAHASISWAAN', 'url' => '#',
    'aktif' => 1, 'newtab' => 0, 'urut' => 3, 'induk' => 0, 'simbol' => ''
]);
DB::table('menu')->insert([
    ['id_sms' => $id_sms, 'nama' => 'Pengumuman',        'url' => '/pengumuman', 'aktif' => 1, 'newtab' => 0, 'urut' => 1, 'induk' => $mahasiswaId, 'simbol' => ''],
    ['id_sms' => $id_sms, 'nama' => 'Agenda & Kegiatan', 'url' => '/agenda',     'aktif' => 1, 'newtab' => 0, 'urut' => 2, 'induk' => $mahasiswaId, 'simbol' => ''],
]);

// Parent: INFORMASI (standalone links)
$infoId = DB::table('menu')->insertGetId([
    'id_sms' => $id_sms, 'nama' => 'INFORMASI', 'url' => '#',
    'aktif' => 1, 'newtab' => 0, 'urut' => 4, 'induk' => 0, 'simbol' => ''
]);
DB::table('menu')->insert([
    ['id_sms' => $id_sms, 'nama' => 'Berita',   'url' => '/berita',  'aktif' => 1, 'newtab' => 0, 'urut' => 1, 'induk' => $infoId, 'simbol' => ''],
    ['id_sms' => $id_sms, 'nama' => 'Artikel',  'url' => '/artikel', 'aktif' => 1, 'newtab' => 0, 'urut' => 2, 'induk' => $infoId, 'simbol' => ''],
]);

echo "Menus inserted OK\n";

// =============================================
// BERITA — 12 realistic dummy articles
// =============================================
$ts = time();
$berita = [
    ['judul'=>'Informatics UPR Raih Juara 1 Lomba Robotika Nasional 2026','isi'=>'<p>Tim mahasiswa Teknik Informatika UPR berhasil meraih juara pertama pada Kompetisi Robot Cerdas Nasional yang diselenggarakan di Jakarta. Robot otonom yang dikembangkan selama 6 bulan mampu mengungguli 47 tim dari seluruh Indonesia. Dekan Fakultas Teknik, Prof. Dr. Ir. Hamdani, menyampaikan apresiasi tertinggi atas pencapaian ini.</p><p>Tim yang terdiri dari 4 mahasiswa semester 5 ini membawa pulang piala bergilir dan dana pembinaan sebesar Rp 50 juta untuk pengembangan laboratorium robotika kampus.</p>','kategori'=>'Prestasi','counters'=>287,'foto'=>'https://picsum.photos/seed/robot2026/800/500'],
    ['judul'=>'Pendaftaran Mahasiswa Baru Jalur Mandiri UPR Resmi Dibuka','isi'=>'<p>Universitas Palangka Raya resmi membuka pendaftaran jalur mandiri untuk tahun ajaran 2026/2027. Calon mahasiswa dapat mendaftar melalui portal PMB UPR mulai 1 Juni hingga 31 Juli 2026.</p><p>Program Studi Teknik Informatika menjadi salah satu prodi dengan peminat tertinggi, dengan kuota sebanyak 120 mahasiswa baru. Informasi selengkapnya dapat diakses di laman pmb.upr.ac.id.</p>','kategori'=>'Akademik','counters'=>912,'foto'=>'https://picsum.photos/seed/pmb2026/800/500'],
    ['judul'=>'Workshop UI/UX Design & Modern Web Development Sukses Digelar','isi'=>'<p>Himpunan Mahasiswa Teknik Informatika (HMTI) menggelar workshop bertajuk "Mendesain Masa Depan Digital" pada 15 April 2026. Workshop ini menghadirkan praktisi dari industri teknologi yang membagikan pengalaman mereka dalam membangun produk digital yang user-friendly.</p><p>Sebanyak 85 peserta dari berbagai angkatan mengikuti sesi hands-on yang berlangsung selama satu hari penuh, mencakup materi Figma, React, dan best practices dalam desain antarmuka.</p>','kategori'=>'Kegiatan','counters'=>164,'foto'=>'https://picsum.photos/seed/workshop2026/800/500'],
    ['judul'=>'Sosialisasi Program MBKM: Magang di Perusahaan Teknologi Terkemuka','isi'=>'<p>Fakultas Teknik UPR menyelenggarakan sosialisasi program Merdeka Belajar Kampus Merdeka (MBKM) untuk semester genap. Program ini membuka kesempatan bagi mahasiswa untuk magang di perusahaan-perusahaan teknologi terkemuka di Indonesia.</p><p>Beberapa mitra industri yang telah menjalin kerja sama antara lain Tokopedia, GoTo, dan Telkom Indonesia. Mahasiswa yang berpartisipasi akan mendapatkan konversi SKS sesuai ketentuan yang berlaku.</p>','kategori'=>'Akademik','counters'=>431,'foto'=>'https://picsum.photos/seed/mbkm2026/800/500'],
    ['judul'=>'Penandatanganan MoU dengan Perusahaan IT Multinasional','isi'=>'<p>Prodi Teknik Informatika UPR resmi menandatangani Nota Kesepahaman (MoU) dengan tiga perusahaan teknologi multinasional. Kerja sama ini mencakup program magang terstruktur, penelitian bersama, dan pengembangan kurikulum berbasis industri.</p><p>Rektor UPR, Prof. Dr. Andrie Elia, menyatakan bahwa kolaborasi ini merupakan langkah strategis untuk meningkatkan daya saing lulusan di pasar kerja global.</p>','kategori'=>'Kerjasama','counters'=>356,'foto'=>'https://picsum.photos/seed/mou2026/800/500'],
    ['judul'=>'Pemilihan Ketua Himpunan Mahasiswa Informatika Periode 2026-2027','isi'=>'<p>Proses demokrasi kampus kembali bergulir dengan diselenggarakannya Pemilu Raya HMTI untuk memilih Ketua dan Wakil Ketua periode 2026-2027. Tiga pasangan calon telah mendaftarkan diri dan menyampaikan visi misi mereka dalam debat terbuka.</p><p>Seluruh mahasiswa aktif program studi Teknik Informatika berhak memberikan suara pada 20 Mei 2026 melalui sistem e-voting yang dikembangkan sendiri oleh tim IT kampus.</p>','kategori'=>'Organisasi','counters'=>98,'foto'=>'https://picsum.photos/seed/pemilu2026/800/500'],
    ['judul'=>'Seminar Nasional: Implementasi Artificial Intelligence di Kalimantan','isi'=>'<p>Program Studi Teknik Informatika UPR menggelar Seminar Nasional bertema "AI untuk Kalimantan: Peluang dan Tantangan" yang dihadiri lebih dari 200 peserta dari berbagai perguruan tinggi di Kalimantan.</p><p>Keynote speaker dari Google Indonesia membahas tentang penerapan Machine Learning untuk konservasi hutan dan pemantauan kualitas udara. Acara ini juga dimeriahkan dengan sesi poster dan presentasi paper dari mahasiswa S1 dan S2.</p>','kategori'=>'Kegiatan','counters'=>245,'foto'=>'https://picsum.photos/seed/aiconf2026/800/500'],
    ['judul'=>'Mahasiswa Informatika Kembangkan Aplikasi Pemantau Kualitas Air Sungai','isi'=>'<p>Sekelompok mahasiswa Teknik Informatika berhasil mengembangkan aplikasi berbasis IoT untuk memantau kualitas air Sungai Kahayan secara real-time. Aplikasi ini menggunakan sensor yang terhubung ke cloud untuk mengukur pH, kekeruhan, dan kandungan oksigen.</p><p>Inovasi ini mendapat perhatian dari Dinas Lingkungan Hidup Kota Palangka Raya dan sedang dalam proses uji coba untuk implementasi skala lebih luas.</p>','kategori'=>'Inovasi','counters'=>178,'foto'=>'https://picsum.photos/seed/iot2026/800/500'],
    ['judul'=>'Pelaksanaan Ujian Akhir Semester Genap 2025/2026','isi'=>'<p>Ujian Akhir Semester (UAS) Genap tahun ajaran 2025/2026 telah resmi dimulai pada 9 Juni 2026. Seluruh mahasiswa dihimbau untuk mempersiapkan diri dengan baik dan mematuhi tata tertib ujian yang berlaku.</p><p>Jadwal ujian dan ruangan dapat dilihat melalui portal SIAKAD. Bagi mahasiswa yang mengalami kendala teknis, dapat menghubungi bagian akademik Fakultas Teknik.</p>','kategori'=>'Akademik','counters'=>520,'foto'=>'https://picsum.photos/seed/uas2026/800/500'],
    ['judul'=>'Kunjungan Industri ke Data Center Telkom Indonesia','isi'=>'<p>Sebanyak 40 mahasiswa Teknik Informatika semester 6 melaksanakan kunjungan industri ke Data Center Telkom Indonesia di Surabaya. Kegiatan ini bertujuan untuk memberikan gambaran nyata tentang infrastruktur teknologi informasi skala enterprise.</p><p>Mahasiswa mendapat kesempatan melihat langsung operasional server farm, sistem pendingin, serta prosedur keamanan data yang diterapkan oleh salah satu perusahaan telekomunikasi terbesar di Indonesia.</p>','kategori'=>'Kegiatan','counters'=>203,'foto'=>'https://picsum.photos/seed/kunjungan2026/800/500'],
    ['judul'=>'Pelatihan Sertifikasi Cisco Networking untuk Mahasiswa','isi'=>'<p>Laboratorium Jaringan Komputer Prodi Teknik Informatika UPR menyelenggarakan pelatihan sertifikasi CCNA (Cisco Certified Network Associate) bagi mahasiswa. Pelatihan ini berlangsung selama 2 minggu dengan instruktur bersertifikat internasional.</p><p>Peserta yang lulus ujian akhir akan mendapatkan sertifikat resmi dari Cisco yang diakui secara global, memberikan nilai tambah saat memasuki dunia kerja.</p>','kategori'=>'Akademik','counters'=>167,'foto'=>'https://picsum.photos/seed/cisco2026/800/500'],
    ['judul'=>'Wisuda Periode III: 85 Lulusan Teknik Informatika Siap Berkarya','isi'=>'<p>Universitas Palangka Raya menggelar wisuda periode III tahun 2026 di Gedung Serbaguna kampus. Sebanyak 85 lulusan dari Program Studi Teknik Informatika diwisuda pada acara ini.</p><p>Lulusan terbaik dengan IPK 3.97 adalah Saudari Amelia Putri yang menyelesaikan studinya dalam waktu 3 tahun 6 bulan. Rektor memberikan pesan agar para wisudawan terus berkontribusi bagi kemajuan teknologi di Kalimantan Tengah.</p>','kategori'=>'Akademik','counters'=>445,'foto'=>'https://picsum.photos/seed/wisuda2026/800/500'],
];

foreach($berita as $i => $b) {
    DB::table('berita')->insert([
        'id_sms'      => $id_sms,
        'judul'       => $b['judul'],
        'isi'         => $b['isi'],
        'ts'          => $ts - ($i * 86400 * 2),
        'tampil'      => 1,
        'counters'    => $b['counters'],
        'kategori'    => $b['kategori'],
        'lengket'     => 0,
        'id_admin'    => 1,
        'caption'     => '',
        'setuju'      => 1,
        'hapus'       => 0,
        'domain'      => '',
        'foto_berita' => $b['foto'],
    ]);
}

echo "12 news articles inserted OK\n";
echo "Done!\n";
