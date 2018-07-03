
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo HTTP_PATH; ?>image/user.png" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $this->session->userdata('nama')?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header"></li>
        <li class="<?php if($title == 'Produk'){echo 'active';}?> treeview">
          <a href="#">
            <i class="fa fa-cart-plus"></i> <span>Produk</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li <?php if($side == 'index' && $title == 'Produk'){echo 'class="active"';}?>><a href="<?php echo base_url('mahasiswa/produk')?>"><i class="fa fa-circle-o"></i> Semua Produk</a></li>
            <li <?php if($side == 'tambah' && $title == 'Produk'){echo 'class="active"';}?>>
              <a href="<?php echo base_url('mahasiswa/produk/tambah');?>">
                <i class="fa fa-plus"></i> <span>Tambah</span>
                <span class="pull-right-container">
                  <small class="label pull-right bg-green">new</small>
                </span>
              </a>
            </li>
          </ul>
        </li>
        <li class="<?php if($title == 'Topup'){echo 'active';}?> treeview">
          <a href="#">
            <i class="fa fa-money"></i> <span>Topup</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li <?php if($side == 'history' && $title == 'Topup'){echo 'class="active"';}?>><a href="<?php echo base_url('mahasiswa/topup/history');?>"><i class="fa fa-circle-o"></i> History</a></li>
            <li <?php if($side == 'tambah'  && $title == 'Topup'){echo 'class="active"';}?>>
              <a href="<?php echo base_url('mahasiswa/topup/tambah');?>">
                <i class="fa fa-plus"></i> <span>Top Up</span>
                <span class="pull-right-container">
                  <small class="label pull-right bg-green">new</small>
                </span>
              </a>
            </li>
          </ul>
        </li>

        <li class="">
          <a href="<?php echo base_url('mahasiswa/penjualan') ?>">
            <i class="fa fa-shopping-cart"></i> <span>Penjualan</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
        </li>
        <li class="">
          <a href="<?php echo base_url('mahasiswa/pembelian') ?>">
            <i class="fa fa-shopping-cart"></i> <span>Pembelian</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
        </li>
        <li class="">
          <a href="<?php echo base_url('mahasiswa/profile') ?>">
            <i class="fa fa-user"></i> <span>Profile</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
        </li>

      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>