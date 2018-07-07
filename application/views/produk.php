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
    <div class="container" style="background-color: white ">

      <div class="row">


        <div class="col-lg-12">
        
          <div class="card mt-4">
            <div class="row">
                <div class="col-md-6">
                  <div style="margin: 15px;">
                  <img class="card-img-top img-thumbnail img-fluid" style="width: 100%; height: 300px;" src="<?php echo base_url('produk/').$produk['id_produk'].$produk['ext']?>" alt="">  
                  </div>
                </div>
                <div class="col-md-6 text-center" style="margin-top: 50px; padding-right: 30px;">
                  <h3 class="card-title" style="color: #42b549; text-transform: uppercase;"><?php echo $produk['produk_name']; ?></h3>
                  <h4>Rp <?php echo number_format($produk['harga'],0,',','.'); ?></h4>
                  <button type="button" style="margin-top: 30px;" class="btn btn-md btn-primary btn-block" data-toggle="modal" <?php echo (isset($level))?'id="buy"':'data-target="#login"' ?>><span class="fa fa-shopping-cart"></span>&nbsp Beli</button>
                </div>
              </div>  

            <div class="card-body">
              <hr>
              <p class="card-text"><?php echo $produk['k_name']; ?></p><br>
              <p class="card-text"><?php echo $produk['deskripsi']; ?></p>
              <p class="card-text"><span class="fa fa-user"></span> <?php echo $produk['nama']; ?></p>
              <!-- <span class="text-warning">&#9733; &#9733; &#9733; &#9733; &#9734;</span>
              4.0 stars -->          
            </div>
          </div>
          <!-- /.card -->

       <!--    <div class="card card-outline-secondary my-4">
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
         /.card -->

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





<!-- Modal -->
<div id="beli" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Beli</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>  
      <div class="modal-body">
        <div class="row">
          <div class="col-md-6">
            <form action="javascript:void(0)" method="POST" accept-charset="utf-8">
            <input type="text" name="id_users" id="id_users" style="display: none;" value="<?php echo $this->session->userdata('id_users'); ?>" placeholder="">
            <input type="text" name="id_produk" id="id_produk" style="display: none;" value="<?php echo $produk['id_produk']; ?>" placeholder="">
            <table>
              <h6>Detail Produk</h6>
                <tr>
                  <th colspan="2">Nama Produk</th>
                </tr>
                <tr>
                  <td colspan="2" style="color: #42b549; text-transform: uppercase;"><?php echo $produk['produk_name']; ?></td>
                </tr>
                <tr>
                  <!-- <th>Jumlah Barang</th> -->
                  <th>Harga Barang</th>
                </tr>
                <tr>
                  <!-- <td><input type="number" id="jumlah" value="1" class="form-control" style="width: 90%;" name="jumlah"></td> -->
                  <td> <input type="text" name="tot" style="background-color: #fff !important; pointer-events: none;" id="tot"  class="form-control" value="<?php echo $produk['harga'];?>" placeholder=""></td>
                </tr>
            </table>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="">Catatan Untuk Penjual</label>
              <textarea name="catatan" id="catatan" class="form-control" placeholder="Catatan"></textarea>
            </div>
          </div>
        </div>
        <hr>
      <div class="row">
        <div class="col-md-12">
          <table class="table">
            <h6>Tujuan Pengiriman</h6>
            <tr>
              <th>Alamat :</th>
              <td><?php echo $user['alamat']; ?></td>
            </tr>
            <tr>
              <th>Kota/Kab :</th>
              <td><?php getKota($user['kota_kab']); ?></td>
            </tr>
            <tr>
              <th>No Tlp :</th>
              <td><?php echo $user['telp']; ?></td>
            </tr>
          </table>
        </div>
      </div>
      <hr>
      <div class="row">
        <div class="col-md-12">
          <table class="table">
            <tr>
              <th>Paket Pengiriman</th>
              <th>Subtotal</th>
            </tr>
            <tr>
              <?php hitung_ongkir($asal,$tujuan);?>
              <td><input type="text" name="subtotal" style="background-color: #fff !important; pointer-events: none;" id="subtot"  class="form-control" value="<?php echo $produk['harga'];?>" placeholder=""></td>
            </tr>
          </table>
        </div>
      </div>
      </div>
      <div class="modal-footer">
        <button type="button" onclick="beli()" class="btn btn-info btn-flat btn-block"><span class="fa fa-shopping-cart"></span>&nbsp Beli Produk ini</button>
            </form>
      </div>
    </div>
  </div>
</div>

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



  <script>
    var url = '<?php echo base_url(); ?>';
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

    var d = null;

    // $('#jumlah').keyup(function() {
    //   var tot = $('#jumlah').val()*'<?php echo $produk['harga'] ?>';
    //   $('#tot').val(tot);
    //   // d = $('#ong').val();
      // var o = d.split(',');
      // var t = parseInt($('#tot').val());
      // var total = tot + parseInt(o[1]);
    //   $('#subtot').val(tot);
    
    // });

    $('#ong').change(function() {
      d = $('#ong').val();
      var o = d.split(',');
      var t = parseInt($('#tot').val());
      var total = t + parseInt(o[1]);
      console.log(total);
      $('#subtot').val(total);
    });

    $('#buy').click(function(){
       $('#beli').modal({
          show     : true,
          backdrop : 'static',
          keyboard : false,
      });
    })
    function beli(){
        $.ajax({
          url: url+'panel/beli',
          type: 'POST',
          data: {
            id_users    : $('#id_users').val(),
            id_produk   : $('#id_produk').val(),
            // jumlah      : $('#jumlah').val(),
            service     : $('#ong').val(),
            subtotal    : $('#subtot').val(),
            catatan     : $('#catatan').val(),
          },
          success:function(result){
            var obj = $.parseJSON(result);
            if (obj.result){
              $('#beli').modal('hide');
              $('#jneis_transaksi').modal({
                  show     : true,
                  backdrop : 'static',
                  keyboard : false,
              });
              $('#id_pem').val(obj.id_pem);
              $('#totbayar').html('<strong>'+obj.subtot+'</strong>');
              $('#paket').html(obj.paket);
              $('#jml').html(obj.jml);
              $('#ctt').html(obj.ctt);
            }
          }
        });    
    }

  </script>

  </body>

</html>
