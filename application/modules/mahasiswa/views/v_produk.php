<?php 
  $id_users = $this->session->userdata('id_users');
$saldo = $this->db->query("SELECT SUM(jumlah) saldo FROM topup WHERE id_users = '$id_users' AND validasi = '1'")->result()[0]->saldo; ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Semua Produk
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url('mahasiswa/produk');?>"><i class="fa fa-shopping-cart"></i> Produk</a></li>
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
              <a href="<?php echo base_url('mahasiswa/produk/tambah');?>" class="btn btn-success btn-sm pull-right">Tambah Produk</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
               <table id="example1" class="table table-bordered table-striped table-hover table">
                <thead>
                <tr>
                  <th>No</th>
                  <th width="1">Gambar</th>
                  <th>Kategori</th>
                  <th>Nama Produk</th>
                  <th>Harga</th>
                  <th width="1">Status</th>
                  <th width="1">Iklan</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                  <?php
                    $i = 1;
                    foreach ($produk as $d) {
                  ?>
                    <tr>
                      <td width="1"><?php echo $i?></td>
                      <td><img src="<?php echo base_url('thumb/').$d->id_produk.$d->extensi?>" width="100"></td>
                      <td><?php echo $d->kategori?></td>
                      <td><?php echo $d->nama?></td>
                      <td><?php echo 'Rp'.number_format($d->harga)?></td>
                       <?php
                        if($d->aktif == 1){
                      ?>
                      <td><span class="label label-success">Aktif</span></td> 
                      <?php 
                        }else{
                      ?>
                      <td><span class="label label-danger">Tidak Aktif</span></td>
                      <?php   
                        }
                      ?>
                      <?php
                        if($d->iklan == 2){
                      ?>
                      <td><span class="label label-success">Aktif</span></td> 
                      <?php 
                        }else if ($d->iklan == 1) { ?>
                      <td><span class="label label-warning">Request</span></td> 
                      <?php }else if ($d->iklan == 3) { ?>
                      <td><span class="label label-warning">Request Cencel</span></td> 
                      <?php }else{
                      ?>
                      <td><i class="label label-danger">Tidak Aktif</i></td>
                      <?php   
                        }
                      ?>
          
                      <td>
                        <a href="<?php echo base_url('mahasiswa/produk/edit/').$d->id_produk?>" title="edit" class="btn btn-xs btn-info"><i class="fa fa-edit"></i></a>
                        <a href="<?php echo base_url('mahasiswa/produk/doDelete/').$d->id_produk?>" onclick="return confirm('Hapus produk ini ?')" title="edit" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a>
                        <?php if ($saldo >= 5000 && $d->iklan == 0) { ?>
                        <a href="<?php echo base_url('mahasiswa/produk/doReq/').$d->id_produk?>" onclick="return confirm('Minta produk ini untuk di iklan kan ?')" title="Request" class="btn btn-xs btn-warning"><i class="fa fa-barcode"></i></a>
                        <?php }else if ($d->iklan == 2) { ?>
                          <a href="<?php echo base_url('mahasiswa/produk/doReqStop/').$d->id_produk?>" onclick="return confirm('Minta produk ini untuk di batalkan iklankan ?')" title="Request" class="btn btn-xs btn-warning"><i class="fa fa-barcode"></i></a>
                        <?php }else if ($d->iklan == 1) { ?>
                          <a href="javascrip:void(0)" onclick="alert('Menuggu konfirmasi dari admin !')" title="Request" class="btn btn-xs btn-warning"><i class="fa fa-barcode"></i></a>
                        <?php }else if($saldo < 5000 && $d->iklan == 0){ ?>
                         <a href="javascrip:void(0)" onclick="alert('Saldo Anda Tidak Cukup !')" title="Request" class="btn btn-xs btn-warning"><i class="fa fa-barcode"></i></a>
                        <?php } ?>
                      </td>

                    </tr>
                  <?php
                      $i++;
                    }
                  ?>
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
  