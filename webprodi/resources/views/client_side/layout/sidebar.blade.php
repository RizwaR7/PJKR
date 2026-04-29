<div class="col-lg-4">
                <div class="sidebar">
                    <div class="widget popular-posts">
                        <h3 class="widget-title">Populer</h3>
                        <ul>
                            @foreach ($berita_popular as $berita)
                            <li><a
                                    href="{{ route('detail_berita.index', ['id' => $berita->id]) }}">{{ $berita->judul }}</a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="widget recent-posts">
                        <h3 class="widget-title">Terbaru</h3>
                        <ul>
                            @foreach ($berita_recent as $berita)
                            <li><a
                                    href="{{ route('detail_berita.index', ['id' => $berita->id]) }}">{{ $berita->judul }}</a>
                                <span>{{ \Carbon\Carbon::createFromTimestamp($berita->ts)->format('F d, Y') }}</span>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="widget agenda-posts">
                        <h3 class="widget-title">Agenda</h3>
                        <ul>
                            @foreach ($agenda as $agenda_data)
                            <li>
                                <!-- Post inline-->
                                <article class="post-inline ">
                                    <div class="post-inline__header">
                                        <span>
                                            {{ \Carbon\Carbon::createFromTimestamp($agenda_data->ts)->format('d M Y') }}
                                        </span>
                                        <p class="post-inline__link ">
                                            <a
                                                href="{{ route('detail_agenda.index', ['id' => $agenda_data->id_kegiatan]) }}">{{ $agenda_data->judul_kegiatan }}</a>
                                        </p>
                                </article>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>