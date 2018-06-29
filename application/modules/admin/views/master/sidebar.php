
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
            <i class="fa fa-shopping-cart"></i> <span>Produk</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li <?php if($side == 'index' && $title == 'Produk'){echo 'class="active"';}?>><a href="<?php echo base_url('admin/produk')?>"><i class="fa fa-circle-o"></i> Semua Produk</a></li>
            <li <?php if($side == 'tambah' && $title == 'Produk'){echo 'class="active"';}?>>
              <a href="<?php echo base_url('admin/produk/tambah');?>">
                <i class="fa fa-plus"></i> <span>Tambah</span>
                <span class="pull-right-container">
                  <small class="label pull-right bg-green">new</small>
                </span>
              </a>
            </li>
          </ul>
        </li>
        <li class="<?php if($title == 'Kategori'){echo 'active';}?> treeview">
          <a href="#">
            <i class="fa fa-tags"></i> <span>Kategori</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li <?php if($side == 'index' && $title == 'Kategori'){echo 'class="active"';}?>><a href="<?php echo base_url('admin/kategori');?>"><i class="fa fa-circle-o"></i> Semua Kategori</a></li>
            <li <?php if($side == 'tambah' && $title == 'Kategori'){echo 'class="active"';}?>>
              <a href="<?php echo base_url('admin/kategori/tambah');?>">
                <i class="fa fa-plus"></i> <span>Tambah</span>
                <span class="pull-right-container">
                  <small class="label pull-right bg-green">new</small>
                </span>
              </a>
            </li>
          </ul>
        </li>
        <li class="<?php if($title == 'Mahasiswa'){echo 'active';}?> treeview">
          <a href="#">
            <i class="fa fa-user"></i> <span>Mahasiswa</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li <?php if($side == 'index' && $title == 'Mahasiswa'){echo 'class="active"';}?>><a href="<?php echo base_url('admin/mahasiswa');?>"><i class="fa fa-circle-o"></i> Semua Mahasiswa</a></li>
            <li <?php if($side == 'tambah' && $title == 'Mahasiswa'){echo 'class="active"';}?>>
              <a href="<?php echo base_url('admin/mahasiswa/tambah');?>">
                <i class="fa fa-plus"></i> <span>Tambah</span>
                <span class="pull-right-container">
                  <small class="label pull-right bg-green">new</small>
                </span>
              </a>
            </li>
          </ul>
        </li>
        <li class="<?php if($title == 'Users'){echo 'active';}?> treeview">
          <a href="#">
            <i class="fa fa-user"></i> <span>Users</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li <?php if($side == 'index' && $title == 'Users'){echo 'class="active"';}?>><a href="<?php echo base_url('admin/users');?>"><i class="fa fa-circle-o"></i> Semua Users</a></li>
            <li <?php if($side == 'tambah' && $title == 'Users'){echo 'class="active"';}?>>
              <a href="<?php echo base_url('admin/users/tambah');?>">
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
            <li <?php if($side == 'index' && $title == 'Topup'){echo 'class="active"';}?>><a href="<?php echo base_url('admin/mahasiswa');?>"><i class="fa fa-user"></i> Saldo</a></li>
            <!-- <li <?php if($side == 'index' && $title == 'Topup'){echo 'class="active"';}?>><a href="<?php echo base_url('admin/users');?>"><i class="fa fa-user"></i> Saldo Users</a></li> -->
            <li <?php if($side == 'konfirmasi' && $title == 'Topup'){echo 'class="active"';}?>><a href="<?php echo base_url('admin/topup/konfirmasi');?>"><i class="fa fa-circle-o"></i> Konfirmasi Top Up</a></li>
            <!-- <li <?php if($side == 'konfirmasi users' && $title == 'Topup'){echo 'class="active"';}?>><a href="<?php echo base_url('admin/topup/konfirmasi_users');?>"><i class="fa fa-circle-o"></i> Konfirmasi Pembayaran Users</a></li> -->
            <li <?php if($side == 'tambah mahasiswa'  && $title == 'Topup'){echo 'class="active"';}?>>
              <a href="<?php echo base_url('admin/topup/tambah');?>">
                <i class="fa fa-plus"></i> <span>Top Up</span>
                <span class="pull-right-container">
                  <small class="label pull-right bg-green">new</small>
                </span>
              </a>
            </li>
            <!-- <li <?php if($side == 'tambah users'  && $title == 'Topup'){echo 'class="active"';}?>>
              <a href="<?php echo base_url('admin/topup/tambah_users');?>">
                <i class="fa fa-plus"></i> <span>Top Up Users</span>
                <span class="pull-right-container">
                  <small class="label pull-right bg-green">new</small>
                </span>
              </a>
            </li> -->
          </ul>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>