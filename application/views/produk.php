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


  </head>

  <body style="background-color: rgba(128, 128, 128, 0.3);">

    <!-- Navigation -->
   <nav class="navbar navbar-inverse navbar-expand-lg navbar-dark fixed-top" style="background-color: #007bff;">
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
                    <a class="nav-link" href="<?php echo base_url('mahasiswa/topup'); ?>">Top Up</a>
                  </li>

                <?php }elseif ($level == "user") { ?>
                    <li class="nav-item">
                      <a class="nav-link" href="<?php echo base_url('user/topup'); ?>">Top Up</a>
                    </li>
                <?php } ?>

                <li class="nav-item">
                  <a class="nav-link" href="#">About</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#">Contact</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#">Services</a>
                </li>
          </ul>
                 <form class="navbar-form ml-auto" action="">
            <div class="input-group">
              <input type="text" class="form-control cari" style="" placeholder="Search">
              <div class="input-group-btn">
                <button class="btn btn-info" type="submit">
                  <i class="fa fa-search"></i>
                </button>
              </div>
            </div>
          </form>
        <ul class="navbar-nav ">
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
    <div class="container" style="background-color: white ">

      <div class="row">


        <div class="col-lg-12">

          <div class="card mt-4">
            <img class="card-img-top img-fluid" src="<?php echo base_url('produk/').$produk['id_produk'].$produk['ext']?>" alt="">
            <div class="card-body">
              <h3 class="card-title"><?php echo $produk['produk_name']; ?></h3>
              <h4>Rp <?php echo number_format($produk['harga'],0,',','.'); ?></h4>
              <p class="card-text"><?php echo $produk['deskripsi']; ?></p>
              <p class="card-text"><?php echo $produk['k_name']; ?></p><br>
              <p class="card-text"><span class="fa fa-user"></span> <?php echo $produk['nama']; ?></p>
              <!-- <span class="text-warning">&#9733; &#9733; &#9733; &#9733; &#9734;</span>
              4.0 stars -->
            
            </div>
          </div>
          <!-- /.card -->

          <div class="card card-outline-secondary my-4">
            <div class="card-header">
              Product Reviews
            </div>
            <div class="card-body">
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Omnis et enim aperiam inventore, similique necessitatibus neque non! Doloribus, modi sapiente laboriosam aperiam fugiat laborum. Sequi mollitia, necessitatibus quae sint natus.</p>
              <small class="text-muted">Posted by Anonymous on 3/1/17</small>
              <hr>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Omnis et enim aperiam inventore, similique necessitatibus neque non! Doloribus, modi sapiente laboriosam aperiam fugiat laborum. Sequi mollitia, necessitatibus quae sint natus.</p>
              <small class="text-muted">Posted by Anonymous on 3/1/17</small>
              <hr>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Omnis et enim aperiam inventore, similique necessitatibus neque non! Doloribus, modi sapiente laboriosam aperiam fugiat laborum. Sequi mollitia, necessitatibus quae sint natus.</p>
              <small class="text-muted">Posted by Anonymous on 3/1/17</small>
              <hr>
              <a href="#" class="btn btn-success">Leave a Review</a>
            </div>
          </div>
          <!-- /.card -->

        </div>
        <!-- /.col-lg-9 -->
      </div>
      <!-- /.row -->

    <br>
    </div>
    <!-- /.container -->
    <!-- Footer -->
    <footer class="py-3" style="background-color: #007bff;">
      <div class="container">
        <p class="m-0 text-center text-white">Copyright &copy; Recycle 2018</p>
      </div>
      <!-- /.container -->
    </footer>



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



  <script>

    $('#lv').change(function(){
      if($('#lv').val() == "3") {
        $('#cklv').html('');
        $('#nm').html('');
        $('#cklv').append('<div class="form-group has-feedback"><input name="foto" type="file" class="form-control" placeholder="KTP" required><p>silahkan upload KTP dengan format jpg atau png</p></div>');
      }else{
        $('#cklv').html('');
        $('#nm').html('');
        $('#nm').append('<div class="form-group has-feedback"><input name="nim" type="text" class="form-control" placeholder="NIM" required><span class="glyphicon glyphicon-user form-control-feedback"></span></div>');
        $('#cklv').append('<div class="form-group has-feedback"><input name="bank" type="text" class="form-control" placeholder="Nama Bank" required><span class="glyphicon glyphicon glyphicon-briefcase form-control-feedback"></span></div><div class="form-group has-feedback"><input name="norek" type="text" class="form-control" placeholder="No Rekeing" required><span class="glyphicon glyphicon-link form-control-feedback"></span></div><div class="form-group has-feedback"><input name="foto" type="file" class="form-control" placeholder="KTM" required><p>silahkan upload KTM dengan format jpg atau png</p></div>');
      }
    });

    $('#example1').DataTable({
        "paging": true,
          "lengthChange": false,
          "searching": true,
          "order": [[0, 'desc']],
          "info": true,
          "autoWidth": true,
          "ordering": false,
    });
  </script>

  </body>

</html>
