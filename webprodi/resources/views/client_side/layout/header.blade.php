    <!-- Header-->
    <header class="page-header">
      <!-- RD Navbar-->
      <div class="rd-navbar-wrap mt-2">
        <nav class="rd-navbar rd-navbar_transparent rd-navbar_boxed" data-layout="rd-navbar-fixed"
          data-sm-layout="rd-navbar-fixed" data-sm-device-layout="rd-navbar-fixed" data-md-layout="rd-navbar-fixed"
          data-md-device-layout="rd-navbar-fixed" data-lg-device-layout="rd-navbar-fixed"
          data-lg-layout="rd-navbar-static" data-xl-device-layout="rd-navbar-static"
          data-xl-layout="rd-navbar-static" data-xxl-device-layout="rd-navbar-static"
          data-xxl-layout="rd-navbar-static" data-stick-up-clone="false" data-sm-stick-up="true"
          data-md-stick-up="true" data-lg-stick-up="true" data-md-stick-up-offset="115px"
          data-lg-stick-up-offset="35px" data-body-class="rd-navbar-absolute">
          <!-- RD Navbar Top Panel-->
          <div class="rd-navbar-inner rd-navbar-search-wrap">
            <!-- RD Navbar Panel-->
            <div class="rd-navbar-panel rd-navbar-search-lg_collapsable">
              <button class="rd-navbar-toggle" data-rd-navbar-toggle=".rd-navbar-nav-wrap">
                <span></span>
              </button>
              <!-- RD Navbar Brand-->
              <div class="rd-navbar-brand">
                <a class="brand-name" href="{{ config('app.url') }}">
                  <img width="70px"
                    src="{{ asset('assets/images/logo/' . env('PRODI_ID') . '.png') . '?v=' . time() }}"
                    alt="" />
                </a>
              </div>
            </div>
            <!-- RD Navbar Nav-->
            <div class="rd-navbar-nav-wrap rd-navbar-search_not-collapsable">
              <div class="rd-navbar-search_collapsable">
                <ul class="rd-navbar-nav">
                  @foreach ($menus as $data_menu)
                  <li class="rd-navbar--has-dropdown">
                    @if ($data_menu->newtab == 1)
                    <a href="{{ $data_menu->url }}" target="_blank">{{ $data_menu->nama }}</a>
                    @else
                    <a href="{{ $data_menu->url }}">{{ $data_menu->nama }}</a>
                    @endif
                    @if ($data_menu->submenus->isNotEmpty())
                    <ul class="rd-navbar-dropdown"
                      style="min-width: max-content; display: grid; grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)); grid-gap: 8px;box-shadow: 4px 4px 8px rgba(0,0,0,0.25);border-radius: 1rem;">
                      @foreach ($data_menu->submenus as $submenu)
                      @if($submenu->aktif == 1)
                      <li><a href="{{ $submenu->url }}" style="max-width: 150px;">{{ $submenu->nama }}</a>
                        <hr class="sidebar-divider">
                      </li>
                      @endif
                      @endforeach
                    </ul>
                    @endif
                  </li>
                  @endforeach
                  {{-- Fitur Multilanguage Default --}}
                  <!-- <li class="rd-navbar--has-dropdown">
                                    <a href="javascript:void(0)"><i class="fas fa-language"
                                            style="margin-right: 10px;"></i>Bahasa</a>
                                    <ul class="rd-navbar-dropdown" style="width: auto; padding: 0;">
                                        <li>
                                            <div style="display: flex; align-items: center;">
                                                <div id="google_translate_element"></div>
                                                <script type="text/javascript">
                                                    function googleTranslateElementInit() {
                                                        new google.translate.TranslateElement({
                                                            pageLanguage: 'id',
                                                            autoDisplay: false,
                                                            multilanguage: true,
                                                            showDropdown: true,
                                                            gaTrack: true,
                                                            includedLanguages: 'id,en,ms,jv,su,zh-CN,zh-TW,ru,ar,de,es,fr,it,pt,nl,ja,ko,vi,hi',
                                                            theme: 'classic',
                                                            layout: google.translate.TranslateElement.InlineLayout.SIMPLE
                                                        }, 'google_translate_element');
                                                    }
                                                </script>
                                                <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit">
                                                </script>
                                            </div>
                                        </li>
                                    </ul>
                                </li> -->
                </ul>
              </div>
            </div>
          </div>
        </nav>
      </div>
    </header>