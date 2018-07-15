<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Semua penjualan
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url('mahasiswa/penjualan');?>"><i class="fa fa-shopping-cart"></i> penjualan</a></li>
        <li class="active">Semua</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title"></h3>
            <!--   <a href="<?php echo base_url('mahasiswa/produk/tambah');?>" class="btn btn-success btn-sm pull-right">Tambah Produk</a> -->
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
          <table class="table table-hover table-strip" id="example1">
            <thead>
              <tr class="info">
                <th>No</th>
                <th style="display: none;">idp</th>
                <th style="width: 10%;">Tgl Pembeli</th>
                <th style="width: 25%;">Detail Produk</th>
                <th>Detail Pembelian</th>
                <th>Status</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php $no = 1; foreach ($produk as $key => $value) { ?>
                <tr>
                  <td><?php echo $no++; ?></td>
                  <td style="display: none;"><?php echo $value['id_pem']; ?></td>
                  <td style="width: 10%;"><?php echo date('d-m-Y H:i:s', strtotime($value['tgl_pem'])) ?></td>
                  <td style="width: 25%;"><table class="table table-bordered">
                      <tr>
                        <td colspan="2">
                          <img class="card-img-top img img-thumbnail img-fluid" style="width: 150px; height: 100px;" src="<?php echo base_url('produk/').$value['id_produk'].$value['extensi']?>" alt="">  
                        </td>
                      </tr>
                      <tr>
                        <th style="width: 30%;">Nama Produk</th>
                        <td><?php echo $value['nama_p'] ?></td>
                      </tr>
                      <tr>
                        <th style="width: 30%;">Penjual</th>
                        <td><?php echo $value['nama_penjual'] ?></td>
                      </tr>
                      <tr>
                        <th style="width: 30%;">Harga</th>
                        <td>Rp. <?php echo number_format($value['harga'],0,',','.'); ?></td>
                      </tr>
                    
                  </table></td>
                  <td>
                    <table class="table table-bordered">
                      <tr>
                        <th>Pembeli</th>
                        <td><?php echo $value['nama_pem']; ?></td>
                      </tr>
                      <tr>
                        <th>Jumlah Pembelian</th>
                        <td><?php echo $value['jumlah'] ?></td>
                      </tr>
                      <tr>
                        <th>Alamat</th>
                        <td><?php echo $value['alamat_p']; ?><br><?php getKota( $value['kota_kab_p']); ?></td>
                      </tr>
                      <tr>
                        <th>Paket Pengiriman</th>
                        <td>JNE <?php echo $value['jenis_paket'].' : Rp'. number_format($value['harga_paket'],0,',','.');  ?></td>
                      </tr>
                      <tr>
                        <th>Total Pembayaran</th>
                        <td>Rp. <?php echo number_format($value['subtotal'],0,',','.'); ?></td>
                      </tr>
                    </table>
                  </td>
                  <?php if ($value['status'] == 1 && $value['sts_t'] == 1) {
                    $sts = "Menuggu Pengiriman Oleh Penjual";
                    $aksi = '<button type="button" class="btn btn-success btn-sm u_resi" data-toggle="modal" data-target="#uploadResi">Upload Resi</button>';
                  }else if($value['status'] == 2 && $value['sts_t'] == 1){
                    $sts  = 'Menuggu Konfirmasi Barang Diterima <br>  <table class="table">
                              <tr>  
                                <th>No Resi</th>
                                <td>'.$value['no_resi'].'</td>
                              </tr>
                            </table>
                            <hr>
                            <img src="'.base_url($value['resi_foto']).'" alt="" style="width: 150px; height: 100px;" class="img img-thumbnail img-fluid">
                            ';
                    $aksi = '<button type="button" class="btn btn-warning btn-sm u_resi" data-toggle="modal" data-target="#uploadResi">Update Resi</button>'; 
                  }else if($value['status'] == 3 && $value['sts_t'] == 1){
                    $sts  = 'Barang Telah Diterima, Menuggu Konfirmasi Admin';
                    $aksi = '';
                  }else if($value['status'] == 3 && $value['sts_t'] == 2){
                    $sts  = 'Selamat, Dana Anda sudah Cair, <br> Transaksi Selesai.';
                    $aksi = '';
                  } ?>
                  <td><strong><?php echo $sts;  ?></strong></td>
                  <td><?php echo $aksi; ?></td>
                </tr>
              <?php } ?>
            </tbody>
          </table> 

            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  
    <!-- Modal -->
<div id="uploadResi" class="modal fade" role="dialog">
  <div class="modal-dialog modal-md">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Upload Bukti Pengiriman</h4>
      </div>
      <div class="modal-body">
        <form action="<?php echo base_url('mahasiswa/uploadResi') ?>" method="POST" accept-charset="utf-8" enctype="multipart/form-data">
          <input type="hidden" name="id_pem" id="idp" value="" placeholder="">
          <div class="from-group">
            <label for="">No Resi</label>
            <input type="text" class="form-control" name="no_resi" value="" placeholder="No Resi">
          </div>
          <div class="form-group">
              <label class="">Upload Bukti</label>    
                <input type="file" class="form-control" name="foto" required="">
                <p class="help-block">extensi file harus jpg atau png</p> 
          </div>
      </div>
      <div class="modal-footer">
          <button type="submit" class="btn btn-info btn-md">Upload</button>
          <button type="button" class="btn btn-danger btn-md" data-dismiss="modal">Close</button>
        </form>
      </div>
    </div>

  </div>
</div>

<script type="text/javascript">
  $('.u_resi').click(function(){
  $("#idp").val($(this).closest('tr').children()[1].textContent);
  });
</script>