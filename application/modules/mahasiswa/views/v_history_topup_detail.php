<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Detail Topup
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url('mahasiswa/topup');?>"><i class="fa fa-user"></i> Mahasiswa</a></li>
        <li><a href="<?php echo base_url('mahasiswa/topup/history');?>">History Top Up</a></li>
        <li class="active">Detail</li>
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
        <form class="form-horizontal">
          <div class="box-body">
            <div class="form-group">
              <label class="col-sm-2 control-label">Waktu</label>
              <div class="col-sm-10">
                <input type="text" value="<?php echo $detail->timestamp?>" class="form-control" placeholder="..." disabled>
              </div>
            </div>
          </div>
          <div class="box-body">
            <div class="form-group">
              <label class="col-sm-2 control-label">NIM</label>
              <div class="col-sm-10">
                <input type="text" value="<?php echo $detail->nim?>" class="form-control" placeholder="..." disabled>
              </div>
            </div>
          </div>
          <div class="box-body">
            <div class="form-group">
              <label class="col-sm-2 control-label">Nama Mahasiswa</label>
              <div class="col-sm-10">
                <input type="text"value="<?php echo $detail->nama?>" class="form-control" placeholder="..." disabled>
              </div>
            </div>
          </div>
          <div class="box-body">
            <div class="form-group">
              <label class="col-sm-2 control-label">Jumlah</label>
              <div class="col-sm-10">
                <input type="text" value="<?php echo $detail->jumlah?>" class="form-control" placeholder="..." disabled>
              </div>
            </div>
          </div>
          <div class="box-body">
            <div class="form-group">
              <label class="col-sm-2 control-label">Status</label>
              <div class="col-sm-2">
                <?php
                  if($detail->validasi == 1){
                ?>
                  <input type="text" value="Valid" class="form-control" placeholder="..." disabled>
                <?php 
                  }else{
                ?>
                  <input type="text" value="Tidak Valid" class="form-control" placeholder="..." disabled>
                <?php   
                  }
                ?>
              </div>
            </div>
          </div>
          <div class="box-body">
            <div class="form-group">
              <label class="col-sm-2 control-label">Bukti</label>
              <div class="col-sm-10">
                <img src="<?php echo base_url('bukti/').$detail->id_topup.$detail->extensi?>" width="256">
              </div>
            </div>
          </div>
        </form>
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  