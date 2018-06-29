<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Top Up Mahasiswa
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url('admin/topup');?>"><i class="fa fa-shopping-cart"></i> Top Up</a></li>
        <li class="active">Tambah</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title"></h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form class="form-horizontal" action="<?php echo base_url('admin/topup/add'); ?>" method="POST" enctype="multipart/form-data">
          <div class="box-body">
            <div class="form-group">
              <label class="col-sm-2 control-label">NIM</label>
              <div class="col-sm-10">
                <select class="form-control select2" name="nim" required>
                  <option value="">-</option>
                  <?php
                    foreach($mahasiswa as $d){
                  ?>
                  <option value="<?php echo $d->nim?>"><?php echo $d->nim.' | '.$d->nama?></option>
                  <?php   
                    }
                  ?>
                </select>
              </div>
            </div>
          </div>
          <div class="box-body">
            <div class="form-group">
              <label class="col-sm-2 control-label">Jumlah</label>
              <div class="col-sm-3">
                <select name="jumlah" class="form-control">
                  <option value="20000">Rp20.000</option>
                  <option value="50000">Rp50.000</option>
                  <option value="100000">Rp100.000</option>
                  <option value="150000">Rp150.000</option>
                </select>
              </div>
            </div>
          </div>
          <div class="box-body">
            <div class="form-group">
              <label class="col-sm-2 control-label">Bukti Pembayaran</label>
              <div class="col-sm-3">
                <input type="file" class="form-control" name="bukti" required>
                <p class="help-block">extensi file gambar harus jpg atau png</p>
              </div>
            </div>
          </div>
          <div class="box-body">
            <div class="form-group">
              <label class="col-sm-2 control-label"></label>
              <div class="col-sm-10">
                <p>UNTUK PROSES PENGIKLANAN BARANG ANDA, ANDA HARUS TERLEBIH DAHULU MELAKUKAN PEMBAYARAN MELALUI TRANSFER BANK YANG TERTERA DIBAWAH. SILAHKAN TRANFER SESUI JUMLAH YANG ANDA PILIH DAN UPLOAD BUKTI TRANSFER SEBAGAI TANDA ANDA TELAH MELAKUKAN TOP UP.  SETELAH ITU DATA ANDA DIPROSES LEBIH LANJUT</p>
                <p>TERIMAKASIH, SALAM RECYCLE</p>
                <h5><b>BNI : 290-868-916 a/n Farhan Salim</b></h5>
                </p>
              </div>
            </div>
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
            <button type="submit" name="submit" value="submit" class="btn btn-info pull-right">Simpan</button>
          </div>
          <!-- /.box-footer -->
        </form>
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  