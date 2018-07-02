<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Konfirmasi Transaksi
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url('admin/transaksi');?>"><i class="fa fa-tags"></i> Transaksi</a></li>
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
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                
               <table class="table table-hover table-strip">
            <thead>
              <tr class="info">
                <th>No</th>
                <th style="display: none;">idp</th>
                <th style="width: 10%;">Tgl Pembelian</th>
                <th style="width: 25%;">Detail Produk</th>
                <!-- <th>Jumlah</th> -->
                <th>Paket Pengiriman</th>
                <th>Total</th>
                <th>Aksi</th>
                <th>Status</th>
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
                    $aksi = '<button type="button" id="btninfo" class="bnt btn-sm btn-info" data-toggle="modal">Lanjutkan Pembayaran</button>'; 
                  }else if ($value['status'] == 1 && $value['sts_t'] == 0) {
                    $sts  = "Menuggu Konfimasi Oleh Admin.";
                    $aksi = '<button type="button" id="btninfo" class="bnt btn-sm btn-info" data-toggle="modal">Update Bukti Pembayaran</button>
                    <hr>
                      <div>
                        <img src="'.base_url($value['bukti_foto']).'"  style="width: 150px; height: 100px;" class="img img-thumbnail img-fluid" alt="">
                      </div>
                    ';
                  } ?>
                  <td><?php echo $aksi; ?></td>
                  <td><strong><?php echo $sts;  ?></strong></td>
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
  