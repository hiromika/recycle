<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Tambah Produk
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url('admin/produk');?>"><i class="fa fa-shopping-cart"></i> Produk</a></li>
        <li class="active">Edit</li>
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
        <form class="form-horizontal" action="<?php echo base_url('admin/produk/update'); ?>" method="POST" enctype="multipart/form-data">
          <div class="box-body">
            <div class="form-group">
              <label class="col-sm-2 control-label">Kategori</label>
              <div class="col-sm-10">
                <select class="form-control select2" name="kategori">
                  <?php
                    foreach($kategori as $d){
                  ?>
                  <option value="<?php echo $d->id_kategori?>" <?php if($produk->id_kategori == $d->id_kategori){echo 'selected';}?>><?php echo $d->nama?></option>
                  <?php   
                    }
                  ?>
                </select>
              </div>
            </div>
          </div>
          <div class="box-body">
            <div class="form-group">
              <label class="col-sm-2 control-label">NIM</label>
              <div class="col-sm-10">
                <select class="form-control select2" name="nim">
                  <?php
                    foreach($mahasiswa as $d){
                  ?>
                  <option value="<?php echo $d->id_users?>" <?php if($produk->id_users == $d->nim){echo 'selected';}?>><?php echo $d->nama?></option>
                  <?php   
                    }
                  ?>
                </select>
              </div>
            </div>
          </div>
          <div class="box-body">
            <div class="form-group">
              <label class="col-sm-2 control-label">Nama Produk</label>
              <div class="col-sm-10">
                <input type="text" name="nama" value="<?php echo $produk->nama?>" class="form-control" placeholder="...">
              </div>
            </div>
          </div>
          <div class="box-body">
            <div class="form-group">
              <label class="col-sm-2 control-label">Deskripsi</label>
              <div class="col-sm-10">
                <textarea class="form-control" name="deskripsi" placeholder="..."><?php echo $produk->deskripsi?></textarea>
              </div>
            </div>
          </div>
          <div class="box-body">
            <div class="form-group">
              <label class="col-sm-2 control-label">Harga</label>
              <div class="col-sm-10">
                <input type="number" name="harga" value="<?php echo $produk->harga?>" class="form-control" placeholder="...">
              </div>
            </div>
          </div>
          <div class="box-body">
            <div class="form-group">
              <label class="col-sm-2 control-label">Jumlah</label>
              <div class="col-sm-10">
                <input type="number" name="jumlah" value="<?php echo $produk->jumlah?>" class="form-control" placeholder="...">
              </div>
            </div>
          </div>
          <div class="box-body">
            <div class="form-group">
              <label class="col-sm-2 control-label">Upload Gambar</label>
              <div class="col-sm-10">
                <input type="file" class="form-control" name="foto">
                <p class="help-block">extensi file gambar harus jpg atau png</p>
                <img src="<?php echo base_url('thumb/').$produk->id_produk.$produk->extensi?>" width="256">
              </div>
            </div>
          </div>
          <div class="box-body">
            <div class="form-group">
              <label class="col-sm-2 control-label">Iklan</label>
              <div class="col-sm-2">
                <select name="iklan" class="form-control">
                  <option value="1" <?php if($produk->iklan == 2){echo 'selected';} ?>>Aktif</option>
                  <option value="1" <?php if($produk->iklan == 1){echo 'selected';} ?>>Request</option>
                  <option value="0" <?php if($produk->iklan == 0){echo 'selected';} ?>>Tidak Aktif</option>
                </select>
              </div>
            </div>
          </div>
          <div class="box-body">
            <div class="form-group">
              <label class="col-sm-2 control-label">Status</label>
              <div class="col-sm-2">
                <select name="status" class="form-control">
                  <option value="1" <?php if($produk->aktif == 1){echo 'selected';} ?>>Aktif</option>
                  <option value="0" <?php if($produk->aktif == 0){echo 'selected';} ?>>Tidak Aktif</option>
                </select>
              </div>
            </div>
          </div>
          <input type="hidden" name="id" value="<?php echo $produk->id_produk?>" class="form-control" placeholder="...">
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
  