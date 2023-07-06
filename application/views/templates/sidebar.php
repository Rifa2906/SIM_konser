  <!-- Sidebar -->
  <ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
      <a style="background-color:white;" class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
          <div class="sidebar-brand-text mx-3 text-dark">SIM KONSER</div>
      </a>

      <li class="nav-item">
          <a class="nav-link" href="<?= base_url('Halaman_utama'); ?>">
              <i class="fas fa-fw fa-tachometer-alt"></i>
              <span>Halaman Utama</span></a>
      </li>
      <hr class="sidebar-divider">
      <?php
        if ($this->session->userdata('hak_pengguna') == 'administrator') { ?>
          <div class="sidebar-heading">
              Data Master
          </div>
          <!-- <li class="nav-item">
              <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBootstrap" aria-expanded="true" aria-controls="collapseBootstrap">
                  <i class="far fa-fw fa-window-maximize"></i>
                  <span>Barang</span>
              </a>
              <div id="collapseBootstrap" class="collapse" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
                  <div class="bg-white py-2 collapse-inner rounded">
                      <a class="collapse-item" href="<?= base_url('Jenis_barang'); ?>">Jenis barang</a>
                      <a class="collapse-item" href="<?= base_url('Satuan'); ?>">Satuan</a>
                      <a class="collapse-item" href="<?= base_url('Stok_barang'); ?>">Stok barang</a>
                  </div>
              </div>
          </li> -->
          <li class="nav-item">
              <a class="nav-link" href="<?= base_url('Pesanan_tiket'); ?>">
                  <i class="fas fa-fw fa-file-alt"></i>
                  <span>Data Pesanan</span>
              </a>
          </li>
          <li class="nav-item">
              <a class="nav-link" href="<?= base_url('Checkin'); ?>">
                  <i class="fas fa-fw fa-file-alt"></i>
                  <span>Data Checkin</span>
              </a>
          </li>
          <hr class="sidebar-divider">
          <div class="sidebar-heading">
              Laporan
          </div>
          <li class="nav-item">
              <a class="nav-link" href="<?= base_url('Laporan'); ?>">
                  <i class="fas fa-fw fa-arrow-right"></i>
                  <span>Laporan</span>
              </a>
          </li>

          <hr class="sidebar-divider">
          <div class="sidebar-heading">
              Pengguna
          </div>
          <li class="nav-item">
              <a class="nav-link" href="<?= base_url('Pengguna'); ?>">
                  <i class="fas fa-fw fa-users"></i>
                  <span>Pengguna</span>
              </a>
          </li>
      <?php
        }
        ?>
      <?php
        if ($this->session->userdata('hak_pengguna') == 'staf') { ?>
          <li class="nav-item">
              <a class="nav-link" href="<?= base_url('Checkin'); ?>">
                  <i class="fas fa-fw fa-file-alt"></i>
                  <span>Data Checkin</span>
              </a>
          </li>
      <?php
        }
        ?>





  </ul>

  <!-- Sidebar -->
  <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">