<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Edit Mahasiswa
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url('admin/mahasiswa');?>"><i class="fa fa-user"></i> Mahasiswa</a></li>
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
        <form class="form-horizontal" action="<?php echo base_url('admin/mahasiswa/update'); ?>" method="POST">
          <div class="box-body">
            <div class="form-group">
              <label class="col-sm-2 control-label">NIM</label>
              <div class="col-sm-10">
                <input type="hidden" name="id_users" value="<?php echo $mahasiswa->id_users?>" class="form-control" placeholder="...">
                <input type="text" name="nim" value="<?php echo $mahasiswa->nim?>" class="form-control" placeholder="...">
              </div>
            </div>
          </div>
          <div class="box-body">
            <div class="form-group">
              <label class="col-sm-2 control-label">Nama Mahasiswa</label>
              <div class="col-sm-10">
                <input type="text" name="nama" value="<?php echo $mahasiswa->nama?>" class="form-control" placeholder="...">
              </div>
            </div>
          </div>
          <div class="box-body">
            <div class="form-group">
              <label class="col-sm-2 control-label">Saldo</label>
              <div class="col-sm-10">
                <input type="number" name="jumlah" value="<?php echo $mahasiswa->jum?>" class="form-control" placeholder="...">
              </div>
            </div>
          </div>
          <div class="box-body">
            <div class="form-group">
              <label class="col-sm-2 control-label">Status</label>
              <div class="col-sm-2">
                <select name="status" class="form-control">
                  <option value="1" <?php if($mahasiswa->aktif == 1){echo 'selected';} ?>>Aktif</option>
                  <option value="0" <?php if($mahasiswa->aktif == 0){echo 'selected';} ?>>Tidak Aktif</option>
                </select>
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
  