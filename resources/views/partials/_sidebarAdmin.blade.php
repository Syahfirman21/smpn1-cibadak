    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>
        <li>
          <a href="{{ route('admin.dashboard') }}">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-newspaper-o"></i>
            <span>Berita</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('admin.berita.create') }}"><i class="fa fa-circle-o"></i> Tambah Berita</a></li>
            <li><a href="{{ route('admin.berita.index') }}"><i class="fa fa-circle-o"></i> List Berita <span class="label label-primary pull-right">{{ $amountBeritas }}</span></a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-calendar"></i>
            <span>Agenda</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('admin.agenda.create') }}"><i class="fa fa-circle-o"></i> Tambah Agenda</a></li>
            <li><a href="{{ route('admin.agenda.index') }}"><i class="fa fa-circle-o"></i> List Agenda <span class="label label-primary pull-right">{{ $amountAgendas }}</span></a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-edit"></i>
            <span>PPDB</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('admin.ppdb.regular') }}"><i class="fa fa-circle-o"></i> Hasil ppdb</a></li>
          </ul>
        </li>
        <li>
          <a href="{{ route('admin.gallery.index') }}">
            <i class="fa fa-image"></i> <span>Gallery</span>
            <small class="label pull-right bg-red">{{ $amountGalleries }}</small>
          </a>
        </li>
        <li>
          <a href="{{ route('admin.siswa.index') }}">
            <i class="fa fa-users"></i> <span>Siswa</span>
          </a>
        </li>
        <li>
          <a href="{{ route('admin.guru.index') }}">
            <i class="fa fa-bookmark"></i> <span>Guru</span>
          </a>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-envelope"></i>
            <span>Pesan</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
           {{-- <li><a href="{{ route('admin.saran.index') }}"><i class="fa fa-circle-o"></i> Kotak saran</a></li> --}}
            <li><a href="{{ route('admin.pesan.index') }}"><i class="fa fa-circle-o"></i> Kotak pesan</a></li>
          </ul>
        </li>
        <li>
          <a href="{{ route('admin.home.edit', ['id'=>1]) }}">
            <i class="fa fa-home"></i> <span>Pengaturan Home Page</span>
          </a>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-info-circle"></i>
            <span>Pengaturan Page</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li><a href="{!! route('admin.pages.edit', ['pages'=>'sambutan']) !!}"><i class="fa fa-circle-o"></i>Sambutan Kepala</a></li>
            <li><a href="{!! route('admin.pages.edit', ['pages'=>'kepalaSekolah']) !!}"><i class="fa fa-circle-o"></i>Profil Kepala</a></li>
            <li><a href="{!! route('admin.pages.edit', ['pages'=>'about']) !!}"><i class="fa fa-circle-o"></i>About Page</a></li>
            <li><a href="{!! route('admin.pages.edit', ['pages'=>'profil']) !!}"><i class="fa fa-circle-o"></i>Profil Page</a></li>
            <li><a href="{!! route('admin.pages.edit', ['pages'=>'visiMisi']) !!}"><i class="fa fa-circle-o"></i>Visi Misi Page</a></li>
            <li><a href="{!! route('admin.pages.edit', ['pages'=>'organisasi']) !!}"><i class="fa fa-circle-o"></i>Organisasi Page</a></li>
            <li><a href="{!! route('admin.pages.edit', ['pages'=>'ekskul']) !!}"><i class="fa fa-circle-o"></i>Ekstrakulikuler Page</a></li>
            <li><a href="{!! route('admin.pages.edit', ['pages'=>'fasilitas']) !!}"><i class="fa fa-circle-o"></i>Fasilitas Page</a></li>
            <li><a href="{!! route('admin.pages.edit', ['pages'=>'prestasi']) !!}"><i class="fa fa-circle-o"></i>Prestasi Page</a></li>
            <li><a href="{!! route('admin.pages.edit', ['pages'=>'jadwalPelajaran']) !!}"><i class="fa fa-circle-o"></i>Jadwal Pelajaran Page</a></li>
          </ul>
        </li>
        <li>
          <a href="{{ route('admin.setting') }}">
            <i class="fa fa-gear"></i> <span>Pengaturan</span>
          </a>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
