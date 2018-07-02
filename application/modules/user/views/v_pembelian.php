<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Pembelian
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url('user/profile');?>"><i class="fa fa-user"></i> User</a></li>
        <li class="active">Pembelian</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Daftar Pembelian</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          
         <table class="table table-hover table-strip" id="example1">
            <thead>
              <tr class="info">
                <th>No</th>
                <th style="display: none;">idp</th>
                <th style="width: 10%;">Tgl Pembelian</th>
                <th style="width: 25%;">Detail Produk</th>
                <!-- <th>Jumlah</th> -->
                <th>Paket Pengiriman</th>
                <th>Total</th>
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
                  <!-- <td><?php echo $value['jumlah'] ?></td> -->
                  <td>JNE <?php echo $value['jenis_paket'].' : Rp'. number_format($value['harga_paket'],0,',','.');  ?></td>
                  <td>Rp. <?php echo number_format($value['subtotal'],0,',','.'); ?></td>
                  <?php if ($value['status'] == 0) {
                    $sts  = "Belum Terbayarkan.";
                    $aksi = '<button type="button"  class="bnt btn-sm btn-info btninfo" data-toggle="modal">Lanjutkan Pembayaran</button>'; 
                  }else if ($value['status'] == 1 && $value['sts_t'] == 0) {
                    $sts  = "Menuggu Konfimasi Oleh Admin.";
                    $aksi = '<button type="button" class="bnt btn-sm btn-info btninfo" data-toggle="modal">Update Bukti Pembayaran</button>
                    <hr>
                      <div>
                        <img src="'.base_url($value['bukti_foto']).'"  style="width: 150px; height: 100px;" class="img img-thumbnail img-fluid" alt="">
                      </div>
                    ';
                  }else if ($value['status'] == 1 && $value['sts_t'] == 1) {
                     $sts  = "Pembayaran Berhasil,"."<br>"."Permintaan diteruskan kepenjual";
                    $aksi = '<button type="button" id="" class="bnt btn-sm btn-info" data-toggle="modal" data-target="#infoblmdkrm">Info</button>
                    <hr>
                    ';
                  }else if ($value['status'] == 2 && $value['sts_t'] == 1) {
                     $sts  = 'Selamat barang anda telah dikirim.
                     <table class="table">
                              <tr>  
                                <th>No Resi</th>
                                <td>'.$value['no_resi'].'</td>
                              </tr>
                            </table>
                            <hr>
                            <img src="'.base_url($value['resi_foto']).'" alt="" style="width: 150px; height: 100px;" class="img img-thumbnail img-fluid">
                     ';
                    $aksi = '<a href="KonPen/'.$value['id_pem'].'" class="btn btn-warning btn-sm" title="Konfimasi" onclick="return confirm(\''.'Konfirmasi Diterima ?'.'\')">Konfimasi Barang Diterima</a>';
                  }else if($value['status'] == 3){
                    $sts  = 'Transaksi Selesai';
                    $aksi = '';
                  } ?>
                  <td><strong><?php echo $sts;  ?></strong></td>
                  <td><?php echo $aksi; ?></td>
                </tr>
              <?php } ?>
            </tbody>
          </table> 
        </div>
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  
  <!-- Modal -->
<div id="info" class="modal fade" role="dialog">
  <div class="modal-dialog modal-md">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Info Pembayaran</h4>
      </div>
      <div class="modal-body">
        <table class="table">
            <tr  class="info">
              <td width="1">Total Pembayaran</td>
              <th><h4 id="tot"></h4></th>
            </tr>
        </table>  
        <h4 class="text-center">Silakan Transfer ke Bank BNI : <br><strong>290-868-916 <br>a/n Farhan Salim</strong></h4>
        <hr>
        <strong>Note :</strong><p>Untuk memproses transaksi anda, silakan lakukan pembayaran via bank transfer sesuai total pembayaran anda. Pembayaran harus dilakukan dalam waktu 24 jam atau pesanan akan di batalkan. Pesanan akan diproses setelah anda mengupload bukti transfer anda</p>
        <p class="text-center">”Terimakasih, salam Recycle”</p>
        <hr>
        <form action="<?php echo base_url('user/uploadBukti') ?>" method="POST" accept-charset="utf-8" enctype="multipart/form-data">
          <input type="hidden" name="id_pem" id="idp" value="" placeholder="">
          <div class="form-group">
              <label class="">Upload Bukti Pembayaran</label>    
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

<div id="infoblmdkrm" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Info</h4>
      </div>
      <div class="modal-body">
          <p>Menuggu proses pengiriman barang oleh penjual.</p>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-danger btn-md" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>



<script type="text/javascript">
  $('#btninfo').click(function() {
  $('#info').modal('show');  
  $("#idp").val($(this).closest('tr').children()[1].textContent);
  $("#tot").html($(this).closest('tr').children()[5].textContent);
  });
</script>