<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Tambah Mahasiswa
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url('admin/mahasiswa');?>"><i class="fa fa-user"></i> Mahasiswa</a></li>
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
        <form class="form-horizontal" action="<?php echo base_url('admin/mahasiswa/add'); ?>" method="POST" enctype="multipart/form-data">
          <div class="box-body">
            <div class="form-group">
              <label class="col-sm-2 control-label">NIM</label>
              <div class="col-sm-10">
                <input type="text" name="nim" class="form-control" placeholder="...">
              </div>
            </div>
          </div>
          <div class="box-body">
            <div class="form-group">
              <label class="col-sm-2 control-label">Nama Mahasiswa</label>
              <div class="col-sm-10">
                <input type="text" name="nama" class="form-control" placeholder="...">
              </div>
            </div>
          </div>
          <div class="box-body">
            <div class="form-group">
              <label class="col-sm-2 control-label">Status</label>
              <div class="col-sm-2">
                <select name="status" class="form-control">
                  <option value="1">Aktif</option>
                  <option value="0">Tidak Aktif</option>
                </select>
              </div>
            </div>
          </div>
          <div class="box-body">
            <div class="form-group">
              <label class="col-sm-2 control-label">KTM</label>
              <div class="col-sm-10">
                <input type="file" class="form-control" name="ktm">
                <p class="help-block">extensi file harus jpg atau png</p>
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
  