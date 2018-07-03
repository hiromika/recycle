<?php $level = $this->session->userdata('level')?>
<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Shop Homepage - Start Bootstrap Template</title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo HTTP_PATH; ?>vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="<?php echo HTTP_PATH; ?>css/shop-homepage.css" rel="stylesheet">
     <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="<?php echo HTTP_PATH; ?>home/css/font-awesome.min.css">

        <!-- DataTables -->
  <!-- <link rel="stylesheet" href="<?php echo HTTP_PATH; ?>datatable/dataTables.bootstrap.css"> -->

    <link rel="stylesheet" href="<?php echo HTTP_PATH; ?>datatable/jquery.dataTables.css">

    <script src="<?php echo HTTP_PATH; ?>vendor/jquery/jquery.min.js"></script>

    <style>
  /* Note: Try to remove the following lines to see the effect of CSS positioning */
      .affix {
          top: 0;
          width: 100%;
          z-index: 9999 !important;
      }

      .affix + .container-fluid {
          padding-top: 70px;
      }
      .hed {
        font-family:  'Hoefler Text', Georgia, 'Times New Roman', serif;
        font-weight: normal;
        font-size: 2.2em;
        letter-spacing: .2em;
        line-height: 1.1em;
        margin:0px;
        /*text-align: center;*/
        text-transform: uppercase
      }
      html, body
      {
          height: 100%;
      }
    </style>
  </head>

<body style="background-color: #F1F1F1; padding: 0px;">
   <div class="container-fluid" style="background-color:#42b549;color:#fff;height:110px;">
      <div class="row" style="padding-top: 40px;">
        <div class="col-md-4">
          <h1 class="hed">Recycle</h1>
        </div>
        <div class="col-md-8">
         <form class="form" method="POST" action="<?php echo base_url('panel/search'); ?>">
            <div class="input-group">
              <input type="text" class="form-control cari" style="" name="cari" placeholder="Search">
              <select name="kategori" class="" style="width: 200px !important; border: 1px solid #ced4da;">
                <option value="0">Semua Kategori</option>
                 <?php foreach ($kategori as $key => $value) { ?>
                    <option value="<?php echo $value['id_kategori'] ?>"> <?php echo $value['nama']; ?> </option>
                    <?php } ?>
              </select>
              <div class="input-group-btn">
                <button class="btn btn-info" type="submit">
                  <i class="fa fa-search"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- Navigation -->
   <nav class="navbar navbar-inverse navbar-expand-lg navbar-dark" data-spy="affix" data-offset-top="197" style="background-color: #42b549;">
      <div class="container">
        <a class="navbar-brand" href="<?php echo base_url(); ?>">Recycle</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="nav navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url(); ?>">Home
              <span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">Kategori</a>
                <ul class="dropdown-menu">
                  <?php foreach ($kategori as $key => $value) { ?>

                    <li class="nav-link"><a href="<?php echo base_url();?>panel/home/<?php echo $value['id_kategori'] ?>" class=""><?php echo $value['nama'] ?></a></li>

                    <?php } ?>
                </ul>
              </li>
          <?php 
                if ($level == "admin") { ?>

                  <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url('admin'); ?>">Dashboard</a>
                  </li>

                <?php }elseif ($level == "mahasiswa") { ?>

                  <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url('mahasiswa/produk'); ?>">Dashboard</a>
                  </li> 
                  <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url('mahasiswa/pembelian'); ?>">Pembelian</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url('mahasiswa/topup'); ?>">Top Up</a>
                  </li>
                <?php }elseif ($level == "user") { ?>
                    <li class="nav-item">
                      <a class="nav-link" href="<?php echo base_url('user/pembelian'); ?>">Pembelian</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="<?php echo base_url('user/topup'); ?>">Top Up</a>
                    </li>
                <?php } ?>

                <li class="nav-item">
                  <a class="nav-link" href="<?php echo base_url('panel/about'); ?>">About</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="<?php echo base_url('panel/contact'); ?>">Contact</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="<?php echo base_url('panel/services'); ?>">Services</a>
                </li>
          </ul>
        <ul class="navbar-nav ml-auto">
            <?php if (isset($level)) { ?>
              <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url("$level/profile")?>"><span class="fa fa-user" style=" text-transform: uppercase;"> <?php echo $this->session->userdata('nama'); ?></span></a>
              </li>
               <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url("$level/logout")?>"><span class="fa fa-sign-in"></span> Logout</a>
              </li> 
            <?php }else{ ?>
              <li class="nav-item">
                <a class="nav-link" href="#" data-toggle="modal" data-target="#login"><span class="fa fa-sign-in"></span> Sign In</a>
              </li> 
              <li class="nav-item">
                <a class="nav-link" href="#" data-toggle="modal" data-target="#join"><span class="fa fa-user"></span> Sign Up</a>
              </li>
            <?php } ?>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Page Content -->
    <div class="container" style="background-color: white; height: 100%; ">
      <div class="row">
        <div class="col-lg-12">
          <hr>
          <div class="jumbotron">
            <h4>Tentang Recycle</h4> <hr>

            <h5>Recycle merupakan E-Marketplace yang menyediakan sarana jual-beli barang bekas/ baru untuk mahasiswa Universitas Darma Persada dari Mahasiswa ke konsumen. Semua mahasiswa Universitas Darma Persada dapat menjual barang yang sudah tidak terpakai di Recycle dan melayani pembeli dari seluruh Indonesia.</h5>
          </div>
        </div>
        <!-- /.col-lg-9 -->
      </div>
      <!-- /.row -->
    <br>
    </div>
    <!-- /.container -->
    <!-- Footer -->
  <footer class="py-4" style="background-color: #42b549;">
      <div class="container-fluid text-white">
        <div class="row">
          <div class="col-md-4">
            <h5>Bank Transfer</h5>
            <img src="<?php echo base_url('assets/image/bni.png') ?>" class="img" style="width: 60px; height: 30px" alt="">
          </div>
          <div class="col-md-4">
            <p class="text-center">Copyright &copy; Recycle 2018</p>
          </div>
          <div class="col-md-4">
            <h5>Jasa Pengiriman</h5>
            <img src="<?php echo base_url('assets/image/jne.png') ?>" class="img" style="width: 60px; height: 30px" alt="">
          </div>
        </div>
      </div>
      <!-- /.container -->
    </footer>


    <!-- Modal Login-->
  <div id="jneis_transaksi" class="modal fade" role="dialog">
    <div class="modal-dialog modal-md">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Pilih Metode Pembayaran</h4>
          <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
        </div>
        <div class="modal-body">
          <form action="<?php echo base_url('panel/metode')?>" method="post">
            <input type="hidden" name="id_pem" id="id_pem" value="" placeholder="">
              <table class="table">
                  <tr>
                    <th>Nama Produk </th>
                    <td><?php echo $produk['produk_name']; ?></td>
                  </tr>
                  <tr>
                    <th>Harga</th>
                    <td>Rp. <?php echo number_format($produk['harga'],0,',','.'); ?></td>
                  </tr>
                  <!-- <tr>
                    <th>Jumlah Pembelian</th>
                    <td id="jml"></td>
                  </tr> -->
                  <tr>
                    <th>Paket Pengiriman </th>
                    <td id="paket"></td>
                  </tr>
                  <tr>
                    <th>Catatan </th>
                    <td id="ctt"></td>
                  </tr>
                  <tr>
                    <th>Total Yang Harus Dibayarkan </th>
                    <td id="totbayar"></td>
                  </tr>
              </table>
            <hr>
            <div class="form-group">
              <label for="">Pilih Metode Pembayaran</label>
              <!-- <div class="radio">
                <label><input type="radio" name="metode" value="0"> COD</label>
              </div> -->
              <div class="radio">
                <label><input type="radio" name="metode" selected value="1"> Transfer Bank BNI</label>
              </div>
            </div>
            <h4 id=""></h4>
             
        </div>
        <div class="modal-footer">
            <button name="submit" type="submit" class="btn btn-success btn-block btn-flat">Bayar</button>
          </form>
        </div>
      </div>

    </div>
  </div>  




  <!-- Modal Login-->
  <div id="login" class="modal fade" role="dialog">
    <div class="modal-dialog modal-sm">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Login</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
         
          <form action="<?php echo base_url('panel/login')?>" method="post">
          
            <div class="form-group has-feedback">
              <input name="username" type="text" class="form-control" placeholder="Username" required>
              <span class="glyphicon glyphicon-user form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
              <input name="password" type="password" class="form-control" placeholder="Password" required>
              <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>

            <div class="form-group">
              <div class="text-center">
                <button name="submit" value="login" type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
              </div>
            </div>
          </form>
        </div>
      </div>

    </div>
  </div>  

  <!-- Modal join-->
  <div id="join" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Sign Up</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <form action="<?php echo base_url('panel/signup')?>" method="post" enctype="multipart/form-data">
          <div class="form-group has-feedback">
            <select name="level" id="lv" class="form-control">
              <option value="">~ Pilih Level ~</option>
              <option value="3">~ User ~</option>
              <option value="2">~ Mahasiswa ~</option>
            </select>

            <span class="glyphicon glyphicon-level form-control-feedback"></span>
          </div> 
          <div class="form-group has-feedback">
            <input name="username" type="text" class="form-control" placeholder="Username" required>
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>
          <div id="nm">
            
          </div>
          <div class="form-group has-feedback">
            <input name="nama" type="text" class="form-control" placeholder="Nama" required>
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>
           <div class="form-group has-feedback">
            <input name="email" type="email" class="form-control" placeholder="E-mail" required>
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input name="password" type="password" class="form-control" placeholder="Password" required>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>

         <div id="cklv">
          
         </div>

      <div class="form-group">
            <!-- /.col -->
            <div class="col-xs-4">
              <button name="submit" value="login" type="submit" class="btn btn-primary btn-block btn-flat">Sign Up</button>
            </div>
        </div>
        </form>
        </div>
      </div>

    </div>
  </div>


    <!-- Bootstrap core JavaScript -->
    <script src="<?php echo HTTP_PATH; ?>vendor/jquery/jquery.min.js"></script>
    <script src="<?php echo HTTP_PATH; ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- DataTables -->
  <script src="<?php echo HTTP_PATH; ?>datatable/dataTables.bootstrap.js"></script>



  </body>

</html>
