<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Edit Kategori
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url('admin/kategori');?>"><i class="fa fa-tags"></i> Kategori</a></li>
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
        <form class="form-horizontal" action="<?php echo base_url('admin/kategori/update'); ?>" method="POST" enctype="multipart/form-data">
          <div class="box-body">
            <div class="form-group">
              <label class="col-sm-2 control-label">Nama kategori</label>
              <div class="col-sm-10">
                <input type="text" name="nama" value="<?php echo $kategori->nama?>" class="form-control" placeholder="...">
              </div>
            </div>
          </div>
          <div class="box-body">
            <div class="form-group">
              <label class="col-sm-2 control-label">Status</label>
              <div class="col-sm-2">
                <select name="status" class="form-control">
                  <option value="1" <?php if($kategori->aktif == 1){echo 'selected';} ?>>Aktif</option>
                  <option value="0" <?php if($kategori->aktif == 0){echo 'selected';} ?>>Tidak Aktif</option>
                </select>
              </div>
            </div>
          </div>
          <div class="box-body">
            <div class="form-group">
              <label class="col-sm-2 control-label">Upload Gambar</label>
              <div class="col-sm-10">
                <input type="file" class="form-control" name="foto">
                <p class="help-block">extensi file gambar harus jpg atau png</p>
                <img src="<?php echo base_url('kategori/').$kategori->id_kategori.$kategori->extensi?>" width="256">
              </div>
            </div>
          </div>
          <input type="hidden" name="id" value="<?php echo $kategori->id_kategori?>" class="form-control" placeholder="...">
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
  