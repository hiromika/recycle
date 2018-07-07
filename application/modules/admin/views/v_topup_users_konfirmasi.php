<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Konfirmasi Pembayaran Users
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url('admin/topup');?>"><i class="fa fa-user"></i> Top Up</a></li>
        <li class="active">Konfirmasi</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title"></h3>
              <a href="<?php echo base_url('admin/topup/tambah_users');?>" class="btn btn-success btn-sm pull-right">Top Up</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped table-hover">
                <thead>
                <tr>
                  <th>NIM</th>
                  <th>Nama Mahasiswa</th>
                  <th>Waktu</th>
                  <th>Jumlah</th>
                  <th>Bukti Trnasfer</th>
                  <th width="1"></th>
                </tr>
                </thead>
                <tbody>
                  <?php
                    $i = 1;
                    foreach ($topup as $d) {
                  ?>
                    <tr>
                      <td width="1"><?php echo $i?></td>
                      <td><?php echo $d->nama?></td>
                      <td><?php echo $d->timestamp?></td>
                      <td class="text-right"><?php echo $d->jumlah?></td>
                      <td><img src="<?php echo base_url('bukti/').$d->id_topup.$d->extensi?>" width="256"></td>
                      <td><a href="<?php echo base_url('admin/topup/validasi_users/').$d->id_topup_user?>" title="validasi" class="btn btn-xs btn-success" onclick='return confirm("Apakah anda yakin validasi top up ini?")'><i class="fa fa-check-square-o"></i> </a></td>
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
  