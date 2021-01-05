<ul class="nav">
          <li class="nav-item nav-profile">
            <div class="nav-link">
              <div class="user-wrapper">
                <div class="profile-image">
                @if(Auth::user()->gambar == '')

                  <img src="{{asset('images/user/default.png')}}" alt="profile image">
                @else

                  <img src="{{asset('images/user/'. Auth::user()->gambar)}}" alt="profile image">
                @endif
                </div>
                <div class="text-wrapper">
                  <p class="profile-name">{{Auth::user()->name}}</p>
                  <div>
                    <small class="designation text-muted" style="text-transform: uppercase;letter-spacing: 1px;">{{ Auth::user()->level }}</small>
                    <span class="status-indicator online"></span>
                  </div>
                </div>
              </div>
            </div>
          </li>
          <li class="nav-item {{ setActive(['/', 'home']) }}"> 
            <a class="nav-link" href="{{url('/home')}}">
              <i class="menu-icon mdi mdi-television"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
          @if(Auth::user()->level == 'admin')
          <li class="nav-item {{ setActive(['anggota.index', 'buku.index', 'user.index']) }}">
            <a class="nav-link " data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
              <i class="menu-icon mdi mdi-content-copy"></i>
              <span class="menu-title">Master Data</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse {{ setShow(['anggota.index', 'buku.index', 'user.index']) }}" id="ui-basic">
              <ul class="nav flex-column sub-menu">
                <!-- <li class="nav-item">
                  <a class="nav-link {{ setActive(['anggota.index']) }}" href="{{route('anggota.index')}}">Data Anggota</a>
                </li> -->
                <li class="nav-item">
                  <a class="nav-link {{ setActive('buku.index') }}" href="{{route('buku.index')}}">Data Buku</a>
                </li>
                 <li class="nav-item">
                  <a class="nav-link {{ setActive(['user.index']) }}" href="{{route('user.index')}}">Data User</a>
                </li>
              </ul>
            </div>
          </li>
        
          @endif
          <!-- <li class="nav-item {{ setActive(['transaksi*']) }}">
            <a class="nav-link" href="{{route('transaksi.index')}}">
              <i class="menu-icon mdi mdi-backup-restore"></i>
              <span class="menu-title">Transaksi</span>
            </a>
          </li> -->
          <li class="nav-item {{ setActive('laporan/buku') }}">
            <a class="nav-link" href="{{url('laporan/buku')}}">
              <i class="menu-icon mdi mdi-table"></i>
              <span class="menu-title">Laporan Buku</span>
            </a>
            <!-- <a class="nav-link" data-toggle="collapse" href="#ui-laporan" aria-expanded="false" aria-controls="ui-laporan">
              <i class="menu-icon mdi mdi-table"></i>
              <span class="menu-title">Laporan</span>
              <i class="menu-arrow"></i>
            </a> -->
            <!-- <div class="collapse" id="ui-laporan">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item">
                  <a class="nav-link" href="{{url('laporan/trs')}}">Laporan Transaksi</a>
                </li>
                
                <li class="nav-item">
                  <a class="nav-link" href="">Laporan Anggota</a>
                </li>
               
                 <li class="nav-item">
                  <a class="nav-link" href="{{url('laporan/buku')}}">Laporan Buku</a>
                </li>
              </ul>
            </div> -->
          </li>

          <li class="nav-item"> 
            <a class="nav-link" href="{{url('/message-telegram')}}">
              <i class="menu-icon mdi mdi-message"></i>
              <span class="menu-title">Pesan Telegram</span>
            </a>
          </li>
         
        </ul>